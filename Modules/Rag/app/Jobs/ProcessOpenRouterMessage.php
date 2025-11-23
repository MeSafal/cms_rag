<?php

namespace Modules\Rag\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class ProcessOpenRouterMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 120;  // 2-minute timeout for the job

    protected $messages;
    protected $cacheKey;

    /**
     * Create a new job instance.
     *
     * @param array $messages Array of message objects with 'role' and 'content'
     * @param string $cacheKey Cache key to store the response
     */
    public function __construct(array $messages, string $cacheKey)
    {
        $this->messages = $messages;
        $this->cacheKey = $cacheKey;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $apiKey = env('OPENROUTER_API_KEY');

            if (!$apiKey) {
                throw new Exception('OpenRouter API key not configured');
            }

            // Use direct cURL to bypass SSL certificate issues
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
                    'model' => 'openai/gpt-3.5-turbo',
                    'messages' => $this->messages,
                ]),
                CURLOPT_TIMEOUT => 60,
                CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
                CURLOPT_SSL_VERIFYHOST => false, // Disable SSL verification
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                throw new Exception('cURL error: ' . $curlError);
            }

            Log::info('OpenRouter API Response', [
                'status' => $httpCode,
                'body' => $response,
            ]);

            if ($httpCode === 200) {
                $data = json_decode($response, true);
                
                // Extract the AI response
                $aiResponse = $data['choices'][0]['message']['content'] ?? 'No response received';

                Log::info('OpenRouter AI Response', [
                    'response' => $aiResponse,
                    'cache_key' => $this->cacheKey,
                ]);

                // Cache the response
                Cache::put($this->cacheKey, ['response' => $aiResponse], now()->addMinutes(5));
                
                // Broadcast the response to the user's WebSocket channel
                // Get session ID from cache key metadata
                $sessionId = Cache::get($this->cacheKey . '_session_id');
                
                Log::info('WebSocket broadcast attempt', [
                    'cache_key' => $this->cacheKey,
                    'session_id' => $sessionId,
                    'has_session_id' => !empty($sessionId),
                ]);
                
                if ($sessionId) {
                    try {
                        Log::info('Broadcasting to session: ' . $sessionId);
                        
                        $event = new \Modules\Rag\app\Events\ChatMessageEvent($sessionId, $aiResponse);
                        Log::info('Event created', ['event' => get_class($event)]);
                        
                        broadcast($event);
                        
                        Log::info('Broadcast complete - no errors thrown');
                    } catch (\Exception $e) {
                        Log::error('Broadcast FAILED with exception', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString(),
                        ]);
                    }
                } else {
                    Log::warning('No session ID found for WebSocket broadcast', [
                        'cache_key' => $this->cacheKey,
                    ]);
                }
            } else {
                // Log the error
                Log::error('OpenRouter API error', [
                    'status' => $httpCode,
                    'body' => $response,
                ]);

                Cache::put($this->cacheKey, [
                    'error' => 'Failed to generate response. Please try again.'
                ], now()->addMinutes(5));

                $this->fail(new Exception('OpenRouter API request failed with status: ' . $httpCode));
            }
        } catch (Exception $e) {
            Log::error('Error in ProcessOpenRouterMessage job: ' . $e->getMessage(), [
                'exception' => $e,
                'messages' => $this->messages,
                'cache_key' => $this->cacheKey,
            ]);
            
            Cache::put($this->cacheKey, [
                'error' => 'Failed to generate response. Please try again.'
            ], now()->addMinutes(5));

            $this->fail($e);
        }
    }
}
