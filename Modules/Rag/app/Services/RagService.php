<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class RagService
{
    protected $model = 'openai/gpt-4o-mini';
    protected $timeout = 30;
    protected $queryBuilder;

    public function __construct(SafeQueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function classifyIntent(string $query, array $conversationContext = []): string
    {
        if ($this->isObviouslyBlocked($query)) return 'blocked';

        $lowerQuery = strtolower(trim($query));
        $appName = strtolower(config('app.name', ''));
        
        // Hardcoded greetings and identity questions - casual conversational response
        $casualPhrases = [
            'hi', 'hello', 'hey', 'namaste', 'good morning', 'good afternoon', 
            'thanks', 'thank you', 'bye', 'goodbye',
            'who are you', 'what are you', 'tell me about yourself'
        ];
        
        if (in_array($lowerQuery, $casualPhrases)) {
            Log::info("Intent Classification (hardcoded): casual");
            return 'casual';
        }
        
        // Hardcoded site-related keywords - check for app name dynamically
        $siteKeywords = ['about us', 'this site', 'this website', 'what is this'];
        foreach ($siteKeywords as $keyword) {
            if (str_contains($lowerQuery, $keyword)) {
                Log::info("Intent Classification (hardcoded - site keyword): db_needed");
                return 'db_needed';
            }
        }
        
        // Check if query mentions the app name
        if ($appName && str_contains($lowerQuery, $appName)) {
            Log::info("Intent Classification (hardcoded - app name '$appName'): db_needed");
            return 'db_needed';
        }

        Log::info("Intent Classification Query: $query");
        
        // Generic prompt without mentioning specific site name
        $systemPrompt = "Classify user query into ONE category:

        'casual': ONLY greetings (hi, hello, how are you, thanks, bye)
        'db_needed': ONLY queries about the website's content, articles, blogs, pages, services, or information
        'blocked': EVERYTHING ELSE (coding help, general knowledge, essays, unrelated topics, etc.)

        Default to 'blocked' if unsure.
        Respond with ONLY the category name.";

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        // Add conversation context
        if (!empty($conversationContext)) {
            $messages = array_merge($messages, array_slice($conversationContext, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        $response = $this->callAI($messages, 0.1, 20);
        $intent = trim(strtolower($response));
        
        Log::info("Intent Classification: $intent");
        
        // Validate and default to blocked
        if (!in_array($intent, ['casual', 'db_needed', 'blocked'])) {
            $intent = 'blocked';
        }
        
        return $intent;
    }

    public function processDBNeed(string $query, array $conversationContext = [], int $retryCount = 0): string
    {
        Log::info("processDBNeed - Query: $query, Retry: $retryCount");
        
        $maxRetries = config('rag.max_retries', 2);
        $schema = $this->queryBuilder->getAllowedTablesSchema();
        
        $systemPrompt = "Generate JSON query params to search database.

Tables Available:
$schema

Example Format:
{\"table\":\"articles\",\"columns\":[\"title\",\"description\"],\"where\":[{\"column\":\"title\",\"operator\":\"LIKE\",\"value\":\"%nepaldela%\"}],\"limit\":5}

Instructions:
1. Choose the right table (articles=static pages/about, blogs=news/posts)
2. Select relevant columns 
3. Add WHERE conditions with LIKE for fuzzy search
4. Use % wildcards for fuzzy matching

OUTPUT ONLY THE JSON. NO explanations, NO markdown fences.";

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        if (!empty($conversationContext)) {
            $messages = array_merge($messages, array_slice($conversationContext, -6));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        $response = $this->callAI($messages, 0.2, 200);
        
        Log::info("AI Raw Response: $response");
        
        // Clean up response - remove markdown code blocks
        $response = preg_replace('/^```json\s*|```$/m', '', trim($response));
        $response= preg_replace('/^```\s*|```$/m', '', trim($response));
        
        $queryParams = json_decode($response, true);
        
        if (!$queryParams || !isset($queryParams['table'])) {
            Log::error("Failed to parse JSON");
            Log::error("Raw AI Response: $response");
            Log::error("JSON Error: " . json_last_error_msg());
            
            // Try regex extraction
            if (preg_match('/\{[^}]+\}/s', $response, $matches)) {
                $queryParams = json_decode($matches[0], true);
                if ($queryParams) {
                    Log::info("Successfully extracted JSON from text");
                }
            }
            
            if (!$queryParams || !isset($queryParams['table'])) {
                return "I couldn't understand how to search for that information.";
            }
        }

        Log::info("Parsed Query Params: " . json_encode($queryParams));

        // Build and execute query
        $queryBuilder = $this->queryBuilder->buildQuery($queryParams);
        
        if (!$queryBuilder) {
            return "The requested information source is not available.";
        }

        $result = $this->queryBuilder->executeQuery($queryBuilder);

        if (!$result['success']) {
            Log::error("Query failed: " . ($result['error'] ?? 'Unknown'));
            return "Error retrieving information.";
        }

        if (empty($result['data'])) {
            if ($retryCount < $maxRetries) {
                Log::info("No results, retrying...");
                return $this->processDBNeed($query, $conversationContext, $retryCount + 1);
            }
            
            return "No information found. Try rephrasing your question.";
        }

        // Generate URLs and format response
        return $this->formatResponse($query, $result['data'], $queryParams['table'], $conversationContext);
    }

    protected function formatResponse(string $query, array $data, string $table, array $context): string
    {
        $appUrl = env('APP_URL', 'http://localhost');
        $appName = config('app.name', 'this website');
        $tableConfig = $this->queryBuilder->getTableConfig($table);
        $idColumn = $tableConfig['id_column'] ?? 'id';

        // Add URLs to each result
        foreach ($data as &$item) {
            if (isset($item->$idColumn)) {
                $item->url = "$appUrl/$table/{$item->$idColumn}";
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

        return $this->callAI($messages, 0.7, 300);
    }

    public function callAI(array $messages, float $temperature = 0.7, int $maxTokens = 1000): string
    {
        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey) throw new Exception('OpenRouter API key not configured');

        $ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
        
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
                'HTTP-Referer: ' . config('app.url'),
                'X-Title: ' . config('app.name', 'Laravel Chatbot'),
            ],
            CURLOPT_POSTFIELDS => json_encode([
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => $temperature,
                'max_tokens' => $maxTokens,
            ]),
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error("OpenRouter cURL Error: $curlError");
            throw new Exception("AI Service Unavailable");
        }

        $data = json_decode($response, true);
        return $data['choices'][0]['message']['content'] ?? '';
    }

    private function isObviouslyBlocked(string $query): bool
    {
        foreach (['password', 'secret key', 'env file', 'aws key', 'drop table'] as $term) {
            if (stripos($query, $term) !== false) return true;
        }
        return false;
    }
}
