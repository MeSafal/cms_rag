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

    public $timeout = 120;

    protected $messages;
    protected $cacheKey;

    /**
     * Create a new job instance.
     */
    public function __construct(array $messages, string $cacheKey)
    {
        $this->messages = $messages;
        $this->cacheKey = $cacheKey;
    }

    /**
     * Execute the job.
     */
    public function handle(
        \Modules\Rag\app\Services\IntentHandler $intentHandler,
        \Modules\Rag\app\Services\DatabaseQueryHandler $dbHandler,
        \Modules\Rag\app\Services\ConversationManager $conversationManager
    ): void
    {
        try {
            // Get the last user message
            $lastMessage = end($this->messages);
            $query = $lastMessage['content'] ?? '';

            // Get conversation context
            $context = $conversationManager->getContext();

            // Step 1: Classify Intent
            $intent = $intentHandler->classifyIntent($query, $context);
            Log::info("Intent classified", [
                'query' => $query,
                'intent' => $intent
            ]);

            $responseContent = '';

            // Step 2: Handle based on intent
            if ($intent === 'blocked' || $intent === 'casual') {
                // Use IntentHandler for general responses
                $responseContent = $intentHandler->handleByIntent($intent, $query);
                
            } elseif ($intent === 'db_needed') {
                // Use DatabaseQueryHandler for database queries
                $responseContent = $dbHandler->processQuery($query, $context);
                
                // Log if in debug mode
                if ($dbHandler->isDebugMode()) {
                    Log::info("Debug mode active - returned raw JSON");
                }
            } else {
                // Fallback for unknown intent
                Log::warning("Unknown intent: $intent");
                $responseContent = "I'm not sure how to help with that. Could you rephrase your question?";
            }

            // Store in conversation history
            $conversationManager->addMessage('user', $query);
            $conversationManager->addMessage('assistant', $responseContent);

            // Log response
            Log::info('RAG Response Generated', [
                'intent' => $intent,
                'response_length' => strlen($responseContent),
                'debug_mode' => $dbHandler->isDebugMode()
            ]);

            // Cache response
            Cache::put($this->cacheKey, ['response' => $responseContent], now()->addMinutes(5));

            // Broadcast via WebSocket
            $sessionId = Cache::get($this->cacheKey . '_session_id');
            if ($sessionId) {
                try {
                    $event = new \Modules\Rag\app\Events\ChatMessageEvent($sessionId, $responseContent);
                    broadcast($event);
                    Log::info('Response broadcast successfully');
                } catch (\Exception $e) {
                    Log::error('Broadcast failed: ' . $e->getMessage());
                }
            }

        } catch (Exception $e) {
            Log::error('Error in ProcessOpenRouterMessage job', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            Cache::put($this->cacheKey, [
                'error' => 'Failed to generate response. Please try again.'
            ], now()->addMinutes(5));

            $this->fail($e);
        }
    }

}
