<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DatabaseService
{
    protected $ragService;
    protected $queryBuilder;

    public function __construct(RagService $ragService, SafeQueryBuilder $queryBuilder)
    {
        $this->ragService = $ragService;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Process database-needed query using semantic search
     */
    public function processQuery(string $query, array $conversationContext = []): string
    {
        Log::info("=== DatabaseService START ===");
        Log::info("Query: $query");
        
        // Get embedding service
        $embeddingService = app(\Modules\Rag\app\Services\EmbeddingService::class);
        Log::info("EmbeddingService loaded");
        
        // Generate embedding for query
        Log::info("Generating embedding for query...");
        $queryEmbedding = $embeddingService->generateEmbedding($query);
        
        if (!$queryEmbedding) {
            Log::error("Failed to generate embedding for query");
            return "I couldn't process your query at the moment. Please try again.";
        }
        
        Log::info("Query embedding generated", ['dimension' => count($queryEmbedding)]);
        
        // Find similar embeddings
        $threshold = config('rag.embeddings.similarity_threshold', 0.3);
        $topK = config('rag.embeddings.top_k', 20);
        
        Log::info("Finding similar embeddings", [
            'threshold' => $threshold,
            'topK' => $topK
        ]);
        
        $matches = $embeddingService->findSimilar($queryEmbedding, $topK, $threshold);
        
        Log::info("Similar embeddings found", ['count' => count($matches)]);
        
        if (empty($matches)) {
            Log::warning("No similar embeddings found above threshold $threshold");
            return "No information found. Try rephrasing your question.";
        }
        
        // Log top matches
        foreach (array_slice($matches, 0, 3) as $i => $match) {
            Log::info("Top match #" . ($i+1), [
                'table' => $match['table_name'],
                'entity_id' => $match['entity_id'],
                'similarity' => $match['similarity'],
                'preview' => substr($match['raw_text'], 0, 100)
            ]);
        }
        
        // Group by table and get best matches
        $byTable = [];
        foreach ($matches as $match) {
            $table = $match['table_name'];
            if (!isset($byTable[$table])) {
                $byTable[$table] = [];
            }
            $byTable[$table][] = $match;
        }
        
        Log::info("Matches grouped by table", [
            'tables' => array_keys($byTable),
            'counts' => array_map('count', $byTable)
        ]);
        
        // Get best table (highest average similarity)
        $bestTable = null;
        $bestAvg = 0;
        foreach ($byTable as $table => $tableMatches) {
            $avg = array_sum(array_column($tableMatches, 'similarity')) / count($tableMatches);
            Log::info("Table similarity", [
                'table' => $table,
                'avg_similarity' => $avg,
                'match_count' => count($tableMatches)
            ]);
            
            if ($avg > $bestAvg) {
                $bestAvg = $avg;
                $bestTable = $table;
            }
        }
        
        Log::info("Best table selected", [
            'table' => $bestTable,
            'avg_similarity' => $bestAvg
        ]);
        
        // Fetch actual data from database
        $entityIds = array_unique(array_column($byTable[$bestTable], 'entity_id'));
        
        Log::info("Fetching data from database", [
            'table' => $bestTable,
            'entity_ids' => $entityIds
        ]);
        
        $tableConfig = config("rag.allowed_tables.$bestTable");
        if (!$tableConfig) {
            Log::error("Table config not found", ['table' => $bestTable]);
            return "Configuration error for table: $bestTable";
        }
        
        $idColumn = $tableConfig['id_column'];
        
        $data = DB::table($bestTable)
            ->whereIn($idColumn, $entityIds)
            ->limit(config('rag.max_results', 5))
            ->get()
            ->toArray();
        
        Log::info("Data fetched from database", [
            'count' => count($data),
            'data_preview' => count($data) > 0 ? json_encode($data[0]) : 'empty'
        ]);
        
        if (empty($data)) {
            Log::warning("No data found in database for entity IDs", [
                'table' => $bestTable,
                'ids' => $entityIds
            ]);
            return "No information found. Try rephrasing your question.";
        }
        
        // Format response
        Log::info("Formatting response with AI...");
        $response = $this->formatResponse($query, $data, $bestTable, $conversationContext);
        Log::info("Response formatted", ['length' => strlen($response)]);
        Log::info("=== DatabaseService END ===");
        
        return $response;
    }

    /**
     * Format database results into natural language response
     */
    protected function formatResponse(string $query, array $data, string $table, array $context): string
    {
        $appUrl = env('APP_URL', 'http://localhost');
        $appName = config('app.name', 'this website');
        $tableConfig = config("rag.allowed_tables.$table");
        $idColumn = $tableConfig['id_column'];

        // Add URLs to each result
        foreach ($data as &$item) {
            if (isset($item->$idColumn)) {
                $item->url = "$appUrl/$table/{$item->$idColumn}";
            }
        }

        $dataJson = json_encode($data);
        
        $prompt = config('rag.prompts.format_response');
        $prompt = str_replace('{data}', $dataJson, $prompt);
        $prompt = str_replace('{app_name}', $appName, $prompt);

        $messages = [['role' => 'system', 'content' => $prompt]];
        
        if (!empty($context)) {
            $messages = array_merge($messages, array_slice($context, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        return $this->ragService->callAI($messages, 0.7, 300);
    }
}
