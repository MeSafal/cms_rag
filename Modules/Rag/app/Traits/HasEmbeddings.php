<?php

namespace Modules\Rag\app\Traits;

use App\Jobs\GenerateModelEmbedding;
use Illuminate\Support\Facades\Log;

trait HasEmbeddings
{
    /**
     * Boot the trait - automatically generates embeddings on create/update
     */
    protected static function bootHasEmbeddings()
    {
        // Get table and columns from config
        $tableName = (new static)->getTable();
        $config = config("rag.allowed_tables.$tableName");
        
        if (!$config) {
            Log::warning("Table $tableName not configured for embeddings in rag.allowed_tables");
            return;
        }
        
        $columns = $config['columns'];
        $idColumn = $config['id_column'];
        
        // On model created - generate embedding
        static::created(function ($model) use ($tableName, $columns, $idColumn) {
            static::dispatchEmbeddingJob($model, $tableName, $columns, $idColumn);
        });
        
        // On model updated - regenerate embedding
        static::updated(function ($model) use ($tableName, $columns, $idColumn) {
            static::dispatchEmbeddingJob($model, $tableName, $columns, $idColumn);
        });
        
        // On model deleted - remove embedding
        static::deleted(function ($model) use ($tableName, $idColumn) {
            \DB::table('data_embeddings')
                ->where('table_name', $tableName)
                ->where('entity_id', $model->$idColumn)
                ->delete();
            
            Log::info("Embedding deleted for $tableName ID: {$model->$idColumn}");
        });
    }
    
    /**
     * Dispatch job to generate embedding (non-blocking)
     */
    protected static function dispatchEmbeddingJob($model, $tableName, $columns, $idColumn)
    {
        $data = [];
        foreach ($columns as $column) {
            if (isset($model->$column)) {
                $data[$column] = $model->$column;
            }
        }
        
        // Dispatch to queue - returns immediately, user not blocked
        GenerateModelEmbedding::dispatch(
            $tableName,
            $model->$idColumn,
            $data,
            $columns
        );
        
        Log::info("Embedding job dispatched for $tableName ID: {$model->$idColumn}");
    }
}
