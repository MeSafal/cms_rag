<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;

class ResponseService
{
    protected $ragService;

    public function __construct(RagService $ragService)
    {
        $this->ragService = $ragService;
    }

    /**
     * Generate natural casual response (greetings, identity, etc.)
     */
    public function generateCasualResponse(string $query, array $conversationContext = []): string
    {
        Log::info("ResponseService - Generating casual response for: $query");
        
        $appName = config('app.name', 'this website');
        $prompt = config('rag.prompts.casual_response');
        $prompt = str_replace('{app_name}', $appName, $prompt);
        
        // Add instruction to use context if available
        if (!empty($conversationContext)) {
            $prompt .= "\n\nIMPORTANT: Use the conversation history to provide context-aware responses. If the user is asking a follow-up or similar question, answer based on what was already discussed.";
        }
        
        Log::info("Casual prompt prepared", ['app_name' => $appName, 'has_context' => !empty($conversationContext)]);
        
        $messages = [['role' => 'system', 'content' => $prompt]];
        
        // Add conversation context
        if (!empty($conversationContext)) {
            $messages = array_merge($messages, array_slice($conversationContext, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];
        
        $response = $this->ragService->callAI($messages, 0.7, 150);
        
        Log::info("Casual response generated", ['length' => strlen($response)]);
        
        return $response;
    }

    /**
     * Generate natural blocked response (polite decline)
     */
    public function generateBlockedResponse(string $query): string
    {
        Log::info("ResponseService - Generating blocked response for: $query");
        
        $appName = config('app.name', 'this website');
        $prompt = config('rag.prompts.blocked_response');
        $prompt = str_replace('{app_name}', $appName, $prompt);
        
        $response = $this->ragService->callAI([
            ['role' => 'system', 'content' => $prompt],
            ['role' => 'user', 'content' => $query]
        ], 0.7, 40);
        
        Log::info("Blocked response generated", ['length' => strlen($response)]);
        
        return $response;
    }
}
