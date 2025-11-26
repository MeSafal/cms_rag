<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;

/**
 * Handles database query generation and execution
 * Responsible for converting user queries into database queries
 * and formatting results
 */
class DatabaseQueryHandler
{
    protected $ragService;
    protected $queryBuilder;
    protected $debugMode;

    public function __construct(RagService $ragService, SafeQueryBuilder $queryBuilder)
    {
        $this->ragService = $ragService;
        $this->queryBuilder = $queryBuilder;
        $this->debugMode = config('rag.debug_mode', false);
    }

    /**
     * Generate query parameters from user question using compact format
     * 
     * @param string $query User's question
     * @param array $context Conversation context
     * @param array $attemptHistory History of failed attempts
     * @return array Query parameters in array format
     */
    public function generateQueryParams(string $query, array $context = [], array $attemptHistory = []): array
    {
        Log::info("Generating query params", ['query' => $query, 'attempt' => count($attemptHistory) + 1]);
        
        // Get schema with table descriptions
        $schema = $this->queryBuilder->getAllowedTablesSchema();
        
        // Extract ONLY table names for strict validation
        $allowedTables = array_keys(config('rag.allowed_tables', []));
        $tableList = implode(', ', $allowedTables);
        
        $historyContext = "";
        if (!empty($attemptHistory)) {
            $historyContext = "\nPREVIOUS FAILED ATTEMPTS (DO NOT REPEAT):\n";
            foreach ($attemptHistory as $attempt) {
                $historyContext .= "- Query: " . json_encode($attempt['params']) . "\n";
                $historyContext .= "  Reason: " . ($attempt['reason'] ?? 'No relevant data found') . "\n";
            }
            $historyContext .= "\nSTRATEGY: Try different keywords or broader conditions.\n";
        }

        $systemPrompt = "STRICT DATABASE QUERY GENERATOR.

AVAILABLE TABLES:
$schema

OUTPUT FORMAT (EXACT - NO DEVIATION):
table: TABLE_NAME
columns: col1, col2, col3
where: column OPERATOR value
limit: NUMBER

CRITICAL RULES:
1. table: MUST be one of: $tableList
2. columns: ONLY from table's available columns
3. where: 
   - Use 'LIKE' for text searches (title, description)
   - Use '=' for exact matches (status, id)
   - DO NOT guess exact aliases. Use 'title LIKE %keyword%' instead.
   - Example: title LIKE %about%
4. NO CHAT. NO CONVERSATION. OUTPUT ONLY THE BLOCK.
$historyContext

EXAMPLES:
Input: 'tell me about company'
Output:
table: articles
columns: title, description
where: title LIKE %company%, description LIKE %company%
limit: 1

Input: 'show blogs'
Output:
table: blogs
columns: title, content
where: none
limit: 5
";

        $messages = [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $query]
        ];

        // Add context if available
        if (!empty($context)) {
            // Insert context before the last user message
            array_splice($messages, 1, 0, array_slice($context, -2));
        }

        $response = $this->ragService->callAI($messages, 0.0, 500);

        // Parse with strict validation
        $params = $this->parseCompactFormat($response, $allowedTables);

        // AUTOMATICALLY EXCLUDE REJECTED IDs
        foreach ($attemptHistory as $attempt) {
            if (!empty($attempt['rejected_ids']) && $attempt['table'] === $params['table']) {
                $params['where'][] = [
                    'column' => 'id', // Assuming 'id' is the primary key, ideally should get from config
                    'operator' => 'NOT IN',
                    'value' => $attempt['rejected_ids']
                ];
                Log::info("Auto-excluding rejected IDs", ['ids' => $attempt['rejected_ids']]);
            }
        }

        return $params;
    }

    /**
     * Parse compact format response into array
     * table: articles
     * columns: title, description
     * where: title LIKE %value%
     * limit: 5
     * 
     * @param string $response AI response
     * @param array $allowedTables List of allowed table names from config
     * @return array Parsed parameters
     */
    protected function parseCompactFormat(string $response, array $allowedTables): array
    {
        // Clean response - remove any extra text before/after format
        $response = trim($response);
        
        // Extract only lines that match the format
        $lines = array_map('trim', explode("\n", $response));
        $params = [
            'table' => null,
            'columns' => [],
            'where' => [],
            'limit' => 5
        ];

        foreach ($lines as $line) {
            if (empty($line)) continue;

            // Parse "key: value" format - STRICT
            if (strpos($line, ':') === false) continue;
            
            [$key, $value] = array_map('trim', explode(':', $line, 2));
            
            switch (strtolower($key)) {
                case 'table':
                    $tableName = trim($value);
                    // STRICT VALIDATION against config
                    if (!in_array($tableName, $allowedTables)) {
                        Log::error("Invalid table name from AI", [
                            'requested' => $tableName,
                            'allowed' => $allowedTables
                        ]);
                        throw new \Exception("Invalid table '$tableName'. Must be one of: " . implode(', ', $allowedTables));
                    }
                    $params['table'] = $tableName;
                    break;
                    
                case 'columns':
                    $columns = array_map('trim', explode(',', $value));
                    // Remove empty values
                    $params['columns'] = array_filter($columns);
                    break;
                    
                case 'where':
                    if (strtolower(trim($value)) !== 'none') {
                        $params['where'] = $this->parseWhereConditions($value);
                    }
                    break;
                    
                case 'limit':
                    $limit = (int)$value;
                    // Enforce max limit from config
                    $maxLimit = config('rag.max_results', 5);
                    $params['limit'] = min($limit, $maxLimit);
                    break;
            }
        }

        // STRICT VALIDATION - must have table and columns
        if (!$params['table']) {
            throw new \Exception("CRITICAL: Missing 'table' in AI response. Response: " . substr($response, 0, 200));
        }

        if (empty($params['columns'])) {
            throw new \Exception("CRITICAL: Missing 'columns' in AI response. Response: " . substr($response, 0, 200));
        }

        Log::info("✅ Parsed compact format successfully", [
            'table' => $params['table'],
            'column_count' => count($params['columns']),
            'where_count' => count($params['where']),
            'limit' => $params['limit']
        ]);
        
        return $params;
    }

    /**
     * Parse WHERE conditions from compact format
     * 
     * Example: "title LIKE %about%, status = 1"
     * Returns: [
     *   ['column' => 'title', 'operator' => 'LIKE', 'value' => '%about%'],
     *   ['column' => 'status', 'operator' => '=', 'value' => '1']
     * ]
     */
    protected function parseWhereConditions(string $whereString): array
    {
        $conditions = [];
        $parts = array_map('trim', explode(',', $whereString));

        foreach ($parts as $part) {
            if (empty($part)) continue;
            
            // Match: column OPERATOR value
            // Supports: =, !=, <, >, <=, >=, LIKE
            if (preg_match('/^(\w+)\s+(LIKE|=|!=|<|>|<=|>=)\s+(.+)$/i', $part, $matches)) {
                $value = trim($matches[3]);
                
                // STRIP QUOTES if present (both single and double)
                if ((str_starts_with($value, "'") && str_ends_with($value, "'")) ||
                    (str_starts_with($value, '"') && str_ends_with($value, '"'))) {
                    $value = substr($value, 1, -1);
                }

                $conditions[] = [
                    'column' => trim($matches[1]),
                    'operator' => strtoupper(trim($matches[2])),
                    'value' => $value
                ];
                
                Log::info("✅ Parsed WHERE condition", [
                    'column' => trim($matches[1]),
                    'operator' => strtoupper(trim($matches[2])),
                    'value' => $value
                ]);
            } else {
                Log::warning("⚠️ Failed to parse WHERE condition", ['part' => $part]);
            }
        }

        Log::info("Total WHERE conditions parsed", ['count' => count($conditions)]);
        
        return $conditions;
    }

    /**
     * Execute database query from parameters
     * 
     * @param array $queryParams Query parameters
     * @return array Query execution result
     */
    public function executeQuery(array $queryParams): array
    {
        Log::info("Executing database query", ['params' => $queryParams]);
        
        // Build query
        $queryBuilder = $this->queryBuilder->buildQuery($queryParams);
        
        if (!$queryBuilder) {
            Log::error("Failed to build query", ['params' => $queryParams]);
            return [
                'success' => false,
                'error' => 'Invalid query parameters - table or columns not allowed',
                'data' => []
            ];
        }

        // Execute query
        $result = $this->queryBuilder->executeQuery($queryBuilder);
        
        Log::info("Query execution result", [
            'success' => $result['success'],
            'count' => $result['count'] ?? 0,
            'has_data' => !empty($result['data'])
        ]);

        return $result;
    }

    /**
     * Process database query need (full flow)
     * 
     * @param string $query User's question
     * @param array $context Conversation context
     * @return string Response (compact format in debug mode, formatted text otherwise)
     */
    public function processQuery(string $query, array $context = []): string
    {
        Log::info("Processing database query", [
            'query' => $query,
            'debug_mode' => $this->debugMode
        ]);
        
        try {
            // Step 1: Generate query parameters
            $queryParams = $this->generateQueryParams($query, $context);
            
            // DEBUG MODE: Return formatted query without executing
            if ($this->debugMode) {
                Log::info("Debug mode: Returning query params");
                $debugOutput = "🔍 Debug Mode - Generated Query:\n\n";
                $debugOutput .= "Table: " . $queryParams['table'] . "\n";
                $debugOutput .= "Columns: " . implode(', ', $queryParams['columns']) . "\n";
                $debugOutput .= "Where: " . (empty($queryParams['where']) ? 'none' : json_encode($queryParams['where'])) . "\n";
                $debugOutput .= "Limit: " . $queryParams['limit'];
                return $debugOutput;
            }
            
            // Step 2: Execute query
            $result = $this->executeQuery($queryParams);
            
            if (!$result['success']) {
                Log::error("Query execution failed", ['error' => $result['error'] ?? 'Unknown']);
                return "I encountered an error while searching the database. Please try rephrasing your question.";
            }

            // Step 3: Handle empty results
            if (empty($result['data'])) {
                Log::warning("Query returned no results", ['params' => $queryParams]);
                return "I couldn't find any information matching your question. Could you try asking differently?";
            }

            // Step 4: Format response using AI
            Log::info("Formatting response with AI", ['result_count' => count($result['data'])]);
            return $this->formatResponse($query, $result['data'], $queryParams['table'], $context);
            
        } catch (\Exception $e) {
            Log::error("Exception in processQuery", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // GRACEFUL ERROR MESSAGE FOR USER
            return "I'm having trouble accessing the database right now. Please try again in a moment.";
        }
    }

    /**
     * Format database results into natural language response
     * 
     * @param string $query Original user query
     * @param array $data Database results
     * @param string $table Table name
     * @param array $context Conversation context
     * @return string Formatted response
     */
    protected function formatResponse(string $query, array $data, string $table, array $context): string
    {
        $appUrl = env('APP_URL', 'http://localhost');
        $appName = config('app.name', 'this website');
        $tableConfig = $this->queryBuilder->getTableConfig($table);
        $idColumn = $tableConfig['id_column'] ?? 'id';

        // Add URLs to each result
        foreach ($data as &$item) {
            if (isset($item->$idColumn)) {
                // Use alias if available, otherwise use ID
                if (isset($item->alias) && !empty($item->alias)) {
                    $item->url = "$appUrl/$table/{$item->alias}";
                } else {
                    $item->url = "$appUrl/$table/{$item->$idColumn}";
                }
            }
        }

        $dataJson = json_encode($data);
        
        $systemPrompt = "Answer user's question using this data. Be natural and conversational.
        Data: $dataJson
        
        Include clickable links like: [Read more](URL)
        Be concise and helpful.
        You are assisting with information about $appName.";

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        if (!empty($context)) {
            $messages = array_merge($messages, array_slice($context, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        return $this->ragService->callAI($messages, 0.7, 300);
    }

    /**
     * Get current debug mode status
     * 
     * @return bool
     */
    public function isDebugMode(): bool
    {
        return $this->debugMode;
    }

    /**
     * Set debug mode
     * 
     * @param bool $enabled
     * @return void
     */
    public function setDebugMode(bool $enabled): void
    {
        $this->debugMode = $enabled;
    }
}
