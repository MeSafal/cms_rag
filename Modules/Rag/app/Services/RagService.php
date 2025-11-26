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
        
        // Hardcoded greetings - these are always casual
        $casualPhrases = [
            'hi', 'hello', 'hey', 'namaste', 'good morning', 'good afternoon', 
            'thanks', 'thank you', 'bye', 'goodbye',
            'who are you', 'what are you'
        ];
        
        if (in_array($lowerQuery, $casualPhrases)) {
            Log::info("Intent Classification (hardcoded): casual");
            return 'casual';
        }

        Log::info("Intent Classification Query: $query");
        
        // Get dynamic table descriptions to understand what data we have
        $allowedTables = config('rag.allowed_tables', []);
        $tableDescriptions = [];
        foreach ($allowedTables as $tableName => $config) {
            $tableDescriptions[] = "- {$tableName}: {$config['description']}";
        }
        $availableData = implode("\n", $tableDescriptions);
        
        // CONTEXT-AWARE AI classification using table descriptions
        $systemPrompt = "Classify user query. Output ONLY ONE WORD.

            OUR DATABASE CONTAINS:
            $availableData

            CLASSIFY AS:
            - casual = greetings, thanks, who are you
            - db_needed = ANYTHING about our database content (company, services, articles, blogs, website info, etc.)
            - blocked = coding help, general knowledge, essays, unrelated topics

            EXAMPLES:
            \"tell me about your company\" → db_needed
            \"what services do you offer\" → db_needed
            \"show me articles\" → db_needed
            \"latest blogs\" → db_needed
            \"hello\" → casual
            \"write me python code\" → blocked
            \"what is AI\" → blocked

            DEFAULT: If query relates to ANY of our database content → db_needed
            Otherwise → blocked

            OUTPUT: ONE WORD ONLY (casual/db_needed/blocked)";

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        // Minimal context
        if (!empty($conversationContext)) {
            $messages = array_merge($messages, array_slice($conversationContext, -1));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        $response = $this->callAI($messages, 0.0, 10);
        $intent = trim(strtolower($response));
        
        // Remove any punctuation or extra text
        $intent = preg_replace('/[^a-z_]/', '', $intent);
        
        Log::info("Intent Classification: $intent");
        
        // Strict validation - must be one of the three
        if (!in_array($intent, ['casual', 'db_needed', 'blocked'])) {
            Log::warning("Invalid intent '$intent', defaulting to blocked");
            $intent = 'blocked';
        }
        
        return $intent;
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
