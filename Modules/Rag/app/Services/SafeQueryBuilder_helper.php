    /**
     * Helper to apply a single condition to the query
     */
    protected function applyCondition($query, $condition, $allowedColumns, $boolean = 'and')
    {
        $column = $condition['column'] ?? null;
        $operator = $condition['operator'] ?? '=';
        $value = $condition['value'] ?? null;

        if (!$column || !in_array($column, $allowedColumns)) {
            Log::warning("Invalid column in WHERE: $column");
            return;
        }

        // Sanitize operator
        $allowedOperators = ['=', '!=', '<', '>', '<=', '>=', 'LIKE', 'NOT LIKE'];
        if (!in_array(strtoupper($operator), $allowedOperators)) {
            $operator = '=';
        }

        $query->where($column, $operator, $value, $boolean);
        
        Log::info("Applied WHERE condition", [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ]);
    }
