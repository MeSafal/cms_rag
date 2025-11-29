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
        
        // Generate embedding for query
        $broadcastThinking("Generating embedding for query...");
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
                $data = $results;
                $bestTable = $table;
                $broadcastThinking("Found relevant $displayName!");
                break; // Stop at the first table that yields results
            } else {
                $broadcastThinking("No data in $displayName. Trying other sources...");
            }
        }
        
        if (empty($data)) {
            Log::warning("No data found in database for any matches");
            return "No information found. Try rephrasing your question.";
        }
        
        // Format response
        $broadcastThinking("Formatting response...");
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
                // TODO: Add URL generation logic here
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
