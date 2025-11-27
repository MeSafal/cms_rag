<?php

namespace Modules\Rag\app\Observers;

use App\Jobs\GenerateModelEmbedding;

class EmbeddingObserver
{
    protected $tableName;
    protected $columns;
    protected $idColumn;

    public function __construct(string $tableName, array $columns, string $idColumn = 'id')
    {
        $this->tableName = $tableName;
        $this->columns = $columns;
        $this->idColumn = $idColumn;
    }

    public function created($model)
    {
        $this->generateEmbedding($model);
    }

    public function updated($model)
    {
        $this->generateEmbedding($model);
    }

    public function deleted($model)
    {
        // Remove embeddings when model deleted
        \DB::table('data_embeddings')
            ->where('table_name', $this->tableName)
            ->where('entity_id', $model->{$this->idColumn})
            ->delete();
    }

    protected function generateEmbedding($model)
    {
        $data = [];
        foreach ($this->columns as $column) {
            if (isset($model->$column)) {
                $data[$column] = $model->$column;
            }
        }

        // Dispatch job to generate embedding (non-blocking)
        GenerateModelEmbedding::dispatch(
            $this->tableName,
            $model->{$this->idColumn},
            $data,
            $this->columns
        );
    }
}
