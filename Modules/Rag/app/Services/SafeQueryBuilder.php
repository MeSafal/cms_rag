<?php

namespace Modules\Rag\app\Services;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SafeQueryBuilder
{
    protected $allowedTables;
    protected $maxResults;

    public function __construct()
    {
        $this->allowedTables = config('rag.allowed_tables', []);
        $this->maxResults = config('rag.max_results', 5);
        
        Log::info("SafeQueryBuilder initialized", [
            'tables' => array_keys($this->allowedTables),
            'max_results' => $this->maxResults
        ]);
        
        if (empty($this->allowedTables)) {
            Log::error("RAG config 'allowed_tables' is empty! Check if config/rag.php is loaded properly.");
        }
    }

    /**
     * Validate if a table is allowed to be queried
     */
    public function validateTable(string $table): bool
    {
        return isset($this->allowedTables[$table]);
    }

    /**
     * Build a safe Eloquent query from AI-provided parameters
     * 
     * @param array $params Expected format:
     * [
     *   'table' => 'articles',
     *   'columns' => ['title', 'description'],
     *   'where' => [['column' => 'title', 'operator' => 'LIKE', 'value' => '%About%']],
     *   'limit' => 5
     * ]
     */
    public function buildQuery(array $params): ?Builder
    {
        $table = $params['table'] ?? null;
        
        if (!$table || !$this->validateTable($table)) {
            Log::warning("Invalid table requested: $table");
            return null;
        }

        $tableConfig = $this->allowedTables[$table];
        $allowedColumns = $tableConfig['columns'];

        // Start query
        $query = DB::table($table);

        // Select only allowed columns
        $columns = $params['columns'] ?? ['*'];
        if ($columns !== ['*']) {
            $columns = array_intersect($columns, $allowedColumns);
            if (empty($columns)) {
                Log::warning("No valid columns selected for table: $table");
                return null;
            }
            // Always include ID column
            if (!in_array($tableConfig['id_column'], $columns)) {
                $columns[] = $tableConfig['id_column'];
            }
            $query->select($columns);
        }

        // Apply WHERE conditions
        if (!empty($params['where'])) {
            foreach ($params['where'] as $condition) {
                $column = $condition['column'] ?? null;
                $operator = $condition['operator'] ?? '=';
                $value = $condition['value'] ?? null;

                if (!$column || !in_array($column, $allowedColumns)) {
                    Log::warning("Invalid column in WHERE: $column");
                    continue;
                }

                // Sanitize operator
                $allowedOperators = ['=', '!=', '<', '>', '<=', '>=', 'LIKE', 'NOT LIKE'];
                if (!in_array(strtoupper($operator), $allowedOperators)) {
                    $operator = '=';
                }

                $query->where($column, $operator, $value);
            }
        }

        // Apply LIMIT
        $limit = min($params['limit'] ?? $this->maxResults, $this->maxResults);
        $query->limit($limit);

        return $query;
    }

    /**
     * Execute a query and return results with metadata
     */
    public function executeQuery(Builder $query): array
    {
        try {
            $results = $query->get()->toArray();
            
            return [
                'success' => true,
                'count' => count($results),
                'data' => $results,
            ];
        } catch (Exception $e) {
            Log::error("Query execution failed: " . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => [],
            ];
        }
    }

    /**
     * Get table configuration
     */
    public function getTableConfig(string $table): ?array
    {
        return $this->allowedTables[$table] ?? null;
    }

    /**
     * Get all allowed tables with their descriptions
     */
    public function getAllowedTablesSchema(): string
    {
        $schema = "";
        foreach ($this->allowedTables as $table => $config) {
            $schema .= "Table: $table ({$config['description']})\n";
            $schema .= "Cols: " . implode(', ', $config['columns']) . "\n\n";
        }
        return $schema;
    }
}
