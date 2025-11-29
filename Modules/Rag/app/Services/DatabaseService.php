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
    public function processQuery(string $query, array $conversationContext = [], ?string $sessionId = null): string
    {
        Log::info("=== DatabaseService START ===");
        Log::info("Query: $query");
        
        // Helper to broadcast thinking steps
        $broadcastThinking = function($message) use ($sessionId) {
            if ($sessionId) {
                try {
                    broadcast(new \Modules\Rag\app\Events\ThinkingEvent($sessionId, $message));
                } catch (\Exception $e) {
                    Log::error('Thinking Broadcast FAILED: ' . $e->getMessage());
                }
            }
        };

        // Get embedding service
        $embeddingService = app(\Modules\Rag\app\Services\EmbeddingService::class);
        Log::info("EmbeddingService loaded");
        
        // Expand query with synonyms for better matching
        $expandedQuery = $this->expandQueryWithSynonyms($query);
        Log::info("Query expanded", ['original' => $query, 'expanded' => $expandedQuery]);
        
        // Generate embedding for expanded query
        $broadcastThinking("Searching knowledge base...");
        Log::info("Generating embedding for query...");
        $queryEmbedding = $embeddingService->generateEmbedding($expandedQuery);
        
        if (!$queryEmbedding) {
            Log::error("Failed to generate embedding for query");
            return "I couldn't process your query at the moment. Please try again.";
        }
        
        Log::info("Query embedding generated", ['dimension' => count($queryEmbedding)]);
        
        // Find similar embeddings
        $threshold = config('rag.embeddings.similarity_threshold', 0.3);
        $topK = config('rag.embeddings.top_k', 20);
        
        $broadcastThinking("Searching knowledge base...");
        Log::info("Finding similar embeddings", [
            'threshold' => $threshold,
            'topK' => $topK
        ]);
        
        $matches = $embeddingService->findSimilar($queryEmbedding, $topK, $threshold);
        
        Log::info("Similar embeddings found", ['count' => count($matches)]);
        
        if (empty($matches)) {
            Log::warning("No similar embeddings found above threshold $threshold");
            $broadcastThinking("No relevant data found.");
            return "No information found. Try rephrasing your question.";
        }
        
        $broadcastThinking("Found " . count($matches) . " potential matches. Analyzing...");

        // Group by table and get best matches
        $byTable = [];
        foreach ($matches as $match) {
            $table = $match['table_name'];
            if (!isset($byTable[$table])) {
                $byTable[$table] = [];
            }
            $byTable[$table][] = $match;
        }
        
        // Sort tables by their best match score
        uasort($byTable, function($a, $b) {
            $maxA = max(array_column($a, 'similarity'));
            $maxB = max(array_column($b, 'similarity'));
            return $maxB <=> $maxA; // Descending
        });

        $data = [];
        $bestTable = null;

        // Iterate through tables to find actual data
        foreach ($byTable as $table => $tableMatches) {
            $tableConfig = config("rag.allowed_tables.$table");
            if (!$tableConfig) {
                continue;
            }
            
            // Use friendly display name for user-facing messages
            $displayName = $tableConfig['display_name'] ?? $table;
            $broadcastThinking("Searching $displayName...");
            
            $entityIds = array_unique(array_column($tableMatches, 'entity_id'));
            $idColumn = $tableConfig['id_column'];
            
            $results = DB::table($table)
                ->whereIn($idColumn, $entityIds)
                ->limit(config('rag.max_results', 5))
                ->get()
                ->toArray();
                
            if (!empty($results)) {
                // Add table name to each result for context
                foreach ($results as $key => $result) {
                    $results[$key]->source_table = $displayName;
                }
                
                // Merge results instead of replacing
                $data = array_merge($data, $results);
                $broadcastThinking("Found relevant info in $displayName!");
                
                // If we have enough data (e.g. > 10 items), we can stop
                if (count($data) >= 10) {
                    break;
                }
            }
        }
        
        if (empty($data)) {
            Log::warning("No data found in database for any matches");
            return "No information found. Try rephrasing your question.";
        }
        
        // Format response
        $broadcastThinking("Formatting response...");
        Log::info("Formatting response with AI...");
        $response = $this->formatResponse($query, $data, $conversationContext);
        Log::info("Response formatted", ['length' => strlen($response)]);
        Log::info("=== DatabaseService END ===");
        
        return $response;
    }

    /**
     * Format database results into natural language response
     */
    protected function formatResponse(string $query, array $data, array $context): string
    {
        $appUrl = env('APP_URL', 'http://localhost');
        $appName = config('app.name', 'this website');

        // Add URLs to each result (if possible)
        foreach ($data as &$item) {
            // Try to guess ID column if source_table is present
            if (isset($item->source_table)) {
                // Logic to add URLs could go here if needed
            }
        }

        // Prepare system prompt
        $systemPrompt = config('rag.prompts.format_response');
        $systemPrompt = str_replace('{app_name}', $appName, $systemPrompt);
        $systemPrompt = str_replace('{data}', json_encode($data, JSON_PRETTY_PRINT), $systemPrompt);

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        if (!empty($context)) {
            $messages = array_merge($messages, array_slice($context, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        return $this->ragService->callAI($messages, 0.7, 300);
    }

    /**
     * Expand query with synonyms for better semantic matching
     */
    protected function expandQueryWithSynonyms(string $query): string
    {
        $synonymMap = [
            'class' => 'class coaching course training workshop program',
            'classes' => 'classes coaching courses training workshops programs',
            'course' => 'course class coaching training workshop program',
            'courses' => 'courses classes coaching training workshops programs',
            'workshop' => 'workshop class course training program',
            'workshops' => 'workshops classes courses training programs',
            'training' => 'training class course workshop program coaching',
            'program' => 'program class course workshop training coaching',
            'programs' => 'programs classes courses workshops training coaching',
            'service' => 'service offering solution product',
            'services' => 'services offerings solutions products',
        ];

        $lowerQuery = strtolower($query);
        
        // Check if query contains any synonym and expand it
        foreach ($synonymMap as $word => $synonyms) {
            if (str_contains($lowerQuery, $word)) {
                // Replace the word with its expanded synonyms
                $query = str_ireplace($word, $synonyms, $query);
                break; // Only expand the first match to avoid over-expansion
            }
        }

        return $query;
    }
}
