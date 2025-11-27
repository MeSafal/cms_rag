<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Rag\app\Services\EmbeddingService;

class GenerateModelEmbedding implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tableName;
    protected $entityId;
    protected $data;
    protected $columns;

    public function __construct(string $tableName, int $entityId, array $data, array $columns)
    {
        $this->tableName = $tableName;
        $this->entityId = $entityId;
        $this->data = $data;
        $this->columns = $columns;
    }

    public function handle(EmbeddingService $embeddingService)
    {
        try {
            Log::info("Generating embedding for $this->tableName ID: $this->entityId");
            
            // Concatenate searchable columns
            $textParts = [];
            foreach ($this->columns as $column) {
                if (isset($this->data[$column]) && $this->data[$column]) {
                    $textParts[] = "$column: {$this->data[$column]}";
                }
            }
            
            $rawText = implode(' | ', $textParts);
            
            // Generate embedding
            $embedding = $embeddingService->generateEmbedding($rawText);
            
            if ($embedding) {
                $embeddingService->storeEmbedding(
                    $this->tableName,
                    $this->entityId,
                    'combined',
                    $rawText,
                    $embedding
                );
                
                Log::info("Embedding generated successfully for $this->tableName ID: $this->entityId");
            } else {
                Log::error("Failed to generate embedding for $this->tableName ID: $this->entityId");
            }
        } catch (\Exception $e) {
            Log::error("Error generating embedding: " . $e->getMessage());
        }
    }
}
