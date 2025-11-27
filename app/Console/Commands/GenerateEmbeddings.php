<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\Rag\app\Services\EmbeddingService;

class GenerateEmbeddings extends Command
{
    protected $signature = 'embeddings:generate {table?}';
    protected $description = 'Generate embeddings for database tables';

    public function handle()
    {
        $embeddingService = app(EmbeddingService::class);
        $tableName = $this->argument('table');
        
        $allowedTables = config('rag.allowed_tables', []);
        $tables = $tableName ? [$tableName => $allowedTables[$tableName]] : $allowedTables;

        foreach ($tables as $table => $config) {
            if (!isset($config['columns'])) continue;
            
            $this->info("Processing table: $table");
            
            $records = DB::table($table)->get();
            $this->info("Found {$records->count()} records");
            
            $bar = $this->output->createProgressBar($records->count());
            
            foreach ($records as $record) {
                $idColumn = $config['id_column'] ?? 'id';
                $entityId = $record->$idColumn;
                
                // Concatenate all searchable columns
                $textParts = [];
                foreach ($config['columns'] as $column) {
                    if (isset($record->$column) && $record->$column) {
                        $textParts[] = "$column: {$record->$column}";
                    }
                }
                
                $rawText = implode(' | ', $textParts);
                
                // Generate embedding
                $embedding = $embeddingService->generateEmbedding($rawText);
                
                if ($embedding) {
                    // Store as single combined embedding
                    $embeddingService->storeEmbedding($table, $entityId, 'combined', $rawText, $embedding);
                    $bar->advance();
                } else {
                    $this->error("\nFailed to generate embedding for $table ID: $entityId");
                }
                
                // Rate limit - 1 request per second to avoid API limits
                sleep(1);
            }
            
            $bar->finish();
            $this->newLine(2);
        }
        
        $this->info('Embeddings generated successfully!');
        return 0;
    }
}
