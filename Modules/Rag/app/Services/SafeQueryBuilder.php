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

        // AUTOMATIC STATUS FILTERING: Only show published content
        $query->where('status', 1);
        Log::info("Auto-applied status filter", ['table' => $table, 'status' => 1]);

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
            $likeConditions = [];
            $otherConditions = [];

            foreach ($params['where'] as $condition) {
                $operator = strtoupper($condition['operator'] ?? '=');
                if (in_array($operator, ['LIKE', 'NOT LIKE'])) {
                    $likeConditions[] = $condition;
                } else {
                    $otherConditions[] = $condition;
                }
            }

            // 1. Apply strict filters (AND) - e.g. status=1, id=5
            foreach ($otherConditions as $condition) {
                $this->applyCondition($query, $condition, $allowedColumns);
            }

            // 2. Apply search conditions (OR) - e.g. title LIKE %foo% OR description LIKE %foo%
            if (!empty($likeConditions)) {
                $query->where(function ($q) use ($likeConditions, $allowedColumns) {
                    foreach ($likeConditions as $condition) {
                        $this->applyCondition($q, $condition, $allowedColumns, 'or');
                    }
                });
            }
        }

        // Apply LIMIT
        $limit = min($params['limit'] ?? $this->maxResults, $this->maxResults);
        $query->limit($limit);

        Log::info("Query built successfully", [
            'table' => $table,
            'limit' => $limit,
            'where_count' => count($params['where'] ?? [])
        ]);

        return $query;
    }

    /**
     * Execute a query and return results with metadata
     */
    public function executeQuery(Builder $query): array
    {
        try {
            // Log the actual SQL query that will be executed
            $sql = $query->toSql();
            $bindings = $query->getBindings();
            Log::info("🔍 Executing SQL Query", [
                'sql' => $sql,
                'bindings' => $bindings
            ]);
            
            $results = $query->get()->toArray();
            
            // Detailed logging of results
            Log::info("📊 Query Results", [
                'count' => count($results),
                'has_data' => !empty($results)
            ]);
            
            // Log actual data retrieved (first 2 records for debugging)
            if (!empty($results)) {
                $sampleData = array_slice($results, 0, 2);
                Log::info("✅ Sample Data Retrieved", [
                    'sample_records' => $sampleData
                ]);
            } else {
                Log::warning("⚠️ No data found in database matching criteria");
            }
            
            return [
                'success' => true,
                'count' => count($results),
                'data' => $results,
            ];
        } catch (Exception $e) {
            Log::error("❌ Query execution failed", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
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

    /**
     * Helper to apply a single condition to the query
     */
    protected function applyCondition($query, $condition, $allowedColumns, $boolean = 'and')
    {
        $column = $condition['column'] ?? null;
        $operator = strtoupper($condition['operator'] ?? '=');
        $value = $condition['value'] ?? null;

        if (!$column || !in_array($column, $allowedColumns)) {
            Log::warning("Invalid column in WHERE: $column");
            return;
        }

        // Sanitize operator
        $allowedOperators = ['=', '!=', '<', '>', '<=', '>=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN'];
        if (!in_array($operator, $allowedOperators)) {
            $operator = '=';
        }

        // Handle IN / NOT IN
        if (in_array($operator, ['IN', 'NOT IN'])) {
            if (is_string($value)) {
                $value = array_map('trim', explode(',', $value));
            }
            if (!is_array($value)) {
                $value = [$value];
            }

            if ($operator === 'IN') {
                $query->whereIn($column, $value, $boolean);
            } else {
                $query->whereNotIn($column, $value, $boolean);
            }
        } else {
            // Standard operators
            $query->where($column, $operator, $value, $boolean);
        }
        
        Log::info("Applied WHERE condition", [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ]);
    }
}
