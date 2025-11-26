<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;

/**
 * Handles intent classification and general responses
 * (casual greetings, blocked queries)
 */
class IntentHandler
{
    protected $ragService;
    protected $appName;

    public function __construct(RagService $ragService)
    {
        $this->ragService = $ragService;
        $this->appName = config('app.name', 'this website');
    }

    /**
     * Classify user intent
     * 
     * @param string $query User's question
     * @param array $context Conversation context
     * @return string Intent type: 'casual', 'db_needed', or 'blocked'
     */
    public function classifyIntent(string $query, array $context = []): string
    {
        $intent = $this->ragService->classifyIntent($query, $context);
        
        Log::info("Intent Classification", [
            'query' => $query,
            'intent' => $intent
        ]);
        
        return $intent;
    }

    /**
     * Handle casual conversations (greetings, thanks, etc)
     * 
     * @param string $query User's message
     * @return string AI-generated casual response
     */
    public function handleCasual(string $query): string
    {
        Log::info("Handling casual query: $query");
        
        $casualPrompt = "You are a friendly AI assistant for {$this->appName}. 
        When asked who you are, introduce yourself naturally as the AI assistant for {$this->appName}.
        Respond naturally and conversationally to greetings/messages.
        Keep it brief (1-2 sentences).
        Be warm and helpful.
        Don't provide any sensitive technical or system details.";
        
        $response = $this->ragService->callAI([
            ['role' => 'system', 'content' => $casualPrompt],
            ['role' => 'user', 'content' => $query]
        ], 0.7, 50);
        
        Log::info("Casual response generated", [
            'length' => strlen($response)
        ]);
        
        return $response;
    }

    /**
     * Handle blocked queries (coding help, off-topic, etc)
     * 
     * @param string $query User's question
     * @return string Polite redirection message
     */
    public function handleBlocked(string $query): string
    {
        Log::info("Handling blocked query: $query");
        
        $blockedPrompt = "You are an AI assistant for {$this->appName}.
        The user asked something you cannot help with.
        Politely redirect them to ask about the website instead.
        Keep it brief (1 sentence).
        Be friendly and helpful.
        DO NOT list what you can't do or mention coding/essays/etc.";
        
        $response = $this->ragService->callAI([
            ['role' => 'system', 'content' => $blockedPrompt],
            ['role' => 'user', 'content' => $query]
        ], 0.7, 40);
        
        Log::info("Blocked response generated", [
            'length' => strlen($response)
        ]);
        
        return $response;
    }

    /**
     * Process query based on intent
     * 
     * @param string $intent Intent type
     * @param string $query User's query
     * @return string Response message
     */
    public function handleByIntent(string $intent, string $query): string
    {
        switch ($intent) {
            case 'casual':
                return $this->handleCasual($query);
                
            case 'blocked':
                return $this->handleBlocked($query);
                
            default:
                throw new \Exception("Invalid intent: $intent. Use DatabaseQueryHandler for db_needed.");
        }
    }
}
