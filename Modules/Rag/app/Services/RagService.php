<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;
use Exception;

class RagService
{
    protected $model = 'openai/gpt-4o-mini';
    protected $timeout = 30;

    /**
     * Make an AI call to OpenRouter
     */
    public function callAI(array $messages, float $temperature = 0.7, int $maxTokens = 1000): string
    {
        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey) {
            Log::error("OpenRouter API key not configured");
            throw new Exception('OpenRouter API key not configured');
        }

        Log::info("OpenRouter API Call", [
            'messages_count' => count($messages),
            'temperature' => $temperature,
            'max_tokens' => $maxTokens
        ]);

        $ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
        
        $payload = [
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => $temperature,
            'max_tokens' => $maxTokens,
        ];
        
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
                'HTTP-Referer: ' . config('app.url'),
                'X-Title: ' . config('app.name', 'Laravel Chatbot'),
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error("OpenRouter cURL Error: $curlError");
            throw new Exception("AI Service Unavailable");
        }

        Log::info("OpenRouter Response", [
            'http_code' => $httpCode,
            'response_length' => strlen($response)
        ]);

        $data = json_decode($response, true);
        
        if (!$data || !isset($data['choices'][0]['message']['content'])) {
            Log::error("Invalid OpenRouter Response", [
                'response' => $response,
                'decoded' => $data
            ]);
            return '';
        }

        $content = $data['choices'][0]['message']['content'] ?? '';
        Log::info("AI Response Content", ['length' => strlen($content), 'preview' => substr($content, 0, 100)]);
        
        return $content;
    }
}
