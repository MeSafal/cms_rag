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
        \Modules\Rag\app\Services\RagService $ragService,
        \Modules\Rag\app\Services\ConversationManager $conversationManager
    ): void
    {
        try {
            // Get the last user message
            $lastMessage = end($this->messages);
            $query = $lastMessage['content'] ?? '';

            // Get conversation context
            $context = $conversationManager->getContext();

            // 1. Classify Intent
            $intent = $ragService->classifyIntent($query, $context);
            Log::info("RAG Intent: $intent", ['query' => $query]);

            $responseContent = '';

            if ($intent === 'blocked') {
                // Generate natural decline response without exposing rules
                $appName = config('app.name', 'this website');
                
                $blockedPrompt = "You are an AI assistant for $appName.
                The user asked something you cannot help with.
                Politely redirect them to ask about the website instead.
                Keep it brief (1 sentence).
                Be friendly and helpful.
                DO NOT list what you can't do or mention coding/essays/etc.";
                
                $responseContent = $ragService->callAI([
                    ['role' => 'system', 'content' => $blockedPrompt],
                    ['role' => 'user', 'content' => $query]
                ], 0.7, 40);
            } elseif ($intent === 'casual') {
                // Generate natural conversational response using AI
                $appName = config('app.name', 'this website');
                
                $casualPrompt = "You are a friendly AI assistant for $appName. 
                When asked who you are, introduce yourself naturally as the AI assistant for $appName.
                Respond naturally and conversationally to greetings/messages.
                Keep it brief (1-2 sentences).
                Be warm and helpful.
                Don't provide any sensitive technical or system details.";
                
                $responseContent = $ragService->callAI([
                    ['role' => 'system', 'content' => $casualPrompt],
                    ['role' => 'user', 'content' => $query]
                ], 0.7, 50);
            } else {
                // 2. Process DB Need
                Log::info("RAG DB Needed Query: $query");
                $responseContent = $ragService->processDBNeed($query, $context);
                Log::info("RAG DB Response Length: " . strlen($responseContent));
            }

            // Store in conversation history
            $conversationManager->addMessage('user', $query);
            $conversationManager->addMessage('assistant', $responseContent);

            // Log and Cache Response
            Log::info('RAG Response Generated', [
                'intent' => $intent,
                'response_length' => strlen($responseContent)
            ]);

            Cache::put($this->cacheKey, ['response' => $responseContent], now()->addMinutes(5));

            // Broadcast
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
