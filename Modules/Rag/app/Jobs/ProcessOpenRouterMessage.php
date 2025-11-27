<?php

namespace Modules\Rag\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Modules\Rag\app\Services\IntentClassifier;
use Modules\Rag\app\Services\ResponseService;
use Modules\Rag\app\Services\DatabaseService;
use Modules\Rag\app\Services\ConversationManager;
use Exception;

class ProcessOpenRouterMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messages;
    protected $cacheKey;

    public function __construct(array $messages, string $cacheKey)
    {
        $this->messages = $messages;
        $this->cacheKey = $cacheKey;
    }

    /**
     * Execute the job.
     */
    public function handle(
        IntentClassifier $intentClassifier,
        ResponseService $responseService,
        DatabaseService $databaseService,
        ConversationManager $conversationManager
    ): void
    {
        try {
            // Get the last user message
            $lastMessage = end($this->messages);
            $query = $lastMessage['content'] ?? '';

            // Get conversation context
            $conversationContext = $conversationManager->getContext();

            // 1. Classify Intent
            $intent = $intentClassifier->classify($query, $conversationContext);
            Log::info("RAG Intent: $intent", ['query' => $query]);

            // 2. Generate Response based on intent
            if ($intent === 'casual') {
                $responseContent = $responseService->generateCasualResponse($query, $conversationContext);
            } elseif ($intent === 'blocked') {
                $responseContent = $responseService->generateBlockedResponse($query);
            } else {
                // db_needed
                $responseContent = $databaseService->processQuery($query, $conversationContext);
            }

            // 3. Store in conversation history
            $conversationManager->addMessage('user', $query);
            $conversationManager->addMessage('assistant', $responseContent);

            // 4. Log and Cache Response
            Log::info('RAG Response Generated', [
                'intent' => $intent,
                'response_length' => strlen($responseContent)
            ]);

            Cache::put($this->cacheKey, ['response' => $responseContent], now()->addMinutes(5));

            // 5. Broadcast via WebSocket
            $sessionId = Cache::get($this->cacheKey . '_session_id');
            if ($sessionId) {
                try {
                    $event = new \Modules\Rag\app\Events\ChatMessageEvent($sessionId, $responseContent);
                    broadcast($event);
                } catch (\Exception $e) {
                    Log::error('Broadcast FAILED: ' . $e->getMessage());
                }
            }

        } catch (Exception $e) {
            Log::error('Error in ProcessOpenRouterMessage job: ' . $e->getMessage());
            
            Cache::put($this->cacheKey, [
                'error' => 'Failed to generate response. Please try again.'
            ], now()->addMinutes(5));

            $this->fail($e);
        }
    }
}
