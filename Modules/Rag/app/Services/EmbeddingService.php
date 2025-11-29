<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class EmbeddingService
{
    protected $ragService;
    protected $model = 'openai/text-embedding-3-small';
    protected $dimensions = 1536;

    public function __construct(RagService $ragService)
    {
        $this->ragService = $ragService;
    }

    /**
     * Generate embedding for text
     */
    public function generateEmbedding(string $text): ?array
    {
        try {
            $apiKey = config('rag.api_key');
            if (!$apiKey) {
                throw new Exception('OpenRouter API key not configured');
            }

            // Log API key for debugging (show last 8 chars only)
            $maskedKey = substr($apiKey, 0, 10) . '...' . substr($apiKey, -8);
            Log::info("EmbeddingService - Using API Key", ['key' => $maskedKey]);

            $ch = curl_init('https://openrouter.ai/api/v1/embeddings');
            
            $payload = [
                'model' => $this->model,
                'input' => $text,
            ];
            
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $apiKey,
                    'Content-Type: application/json',
                ],
                CURLOPT_POSTFIELDS => json_encode($payload),
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                Log::error("Embedding API error", ['code' => $httpCode, 'response' => $response]);
                return null;
            }

            $data = json_decode($response, true);
            return $data['data'][0]['embedding'] ?? null;
        } catch (Exception $e) {
            Log::error("Error generating embedding: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Calculate cosine similarity between two vectors
     */
    public function cosineSimilarity(array $vec1, array $vec2): float
    {
        if (count($vec1) !== count($vec2)) {
            return 0.0;
        }

        $dotProduct = 0.0;
        $magnitudeA = 0.0;
        $magnitudeB = 0.0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $magnitudeA += $vec1[$i] * $vec1[$i];
            $magnitudeB += $vec2[$i] * $vec2[$i];
        }

        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0.0;
        }

        return $dotProduct / ($magnitudeA * $magnitudeB);
    }

    /**
     * Find similar embeddings
     */
    public function findSimilar(array $queryVector, int $topK = 20, float $threshold = 0.5): array
    {
        Log::info("=== EmbeddingService::findSimilar START ===");
        Log::info("Parameters", [
            'query_vector_dim' => count($queryVector),
            'topK' => $topK,
            'threshold' => $threshold
        ]);
        
        $embeddings = DB::table('data_embeddings')->get();
        Log::info("Total embeddings in database", ['count' => $embeddings->count()]);
        
        $results = [];

        foreach ($embeddings as $embedding) {
            $storedVector = json_decode($embedding->embedding, true);
            $similarity = $this->cosineSimilarity($queryVector, $storedVector);

            if ($similarity >= $threshold) {
                $results[] = [
                    'table_name' => $embedding->table_name,
                    'entity_id' => $embedding->entity_id,
                    'column_name' => $embedding->column_name,
                    'raw_text' => $embedding->raw_text,
                    'similarity' => $similarity,
                ];
            }
        }

        Log::info("Matches above threshold", [
            'count' => count($results),
            'threshold' => $threshold
        ]);

        // Sort by similarity (highest first)
        usort($results, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        $topResults = array_slice($results, 0, $topK);
        
        Log::info("Returning top K results", ['count' => count($topResults)]);
        Log::info("=== EmbeddingService::findSimilar END ===");
        
        return $topResults;
    }

    /**
     * Store embedding
     */
    public function storeEmbedding(string $tableName, int $entityId, string $columnName, string $rawText, array $embedding): bool
    {
        try {
            DB::table('data_embeddings')->updateOrInsert(
                [
                    'table_name' => $tableName,
                    'entity_id' => $entityId,
                    'column_name' => $columnName,
                ],
                [
                    'raw_text' => $rawText,
                    'embedding' => json_encode($embedding),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
            return true;
        } catch (Exception $e) {
            Log::error("Error storing embedding: " . $e->getMessage());
            return false;
        }
    }
}
