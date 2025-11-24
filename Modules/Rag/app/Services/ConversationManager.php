<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Session;

class ConversationManager
{
    protected $sessionKey = 'rag_conversation_history';
    protected $limit;

    public function __construct()
    {
        $this->limit = config('rag.conversation_history_limit', 5);
    }

    /**
     * Add a message to conversation history
     */
    public function addMessage(string $role, string $content): void
    {
        $history = $this->getHistory();
        
        $history[] = [
            'role' => $role, // 'user' or 'assistant'
            'content' => $content,
            'timestamp' => now()->timestamp,
        ];

        // Keep only last N exchanges (N*2 for user+assistant pairs)
        if (count($history) > ($this->limit * 2)) {
            $history = array_slice($history, -($this->limit * 2));
        }

        Session::put($this->sessionKey, $history);
    }

    /**
     * Get conversation history
     */
    public function getHistory(): array
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Get context formatted for AI prompts (compact)
     */
    public function getContext(): array
    {
        $history = $this->getHistory();
        
        // Return only role and content for AI
        return array_map(function($msg) {
            return [
                'role' => $msg['role'],
                'content' => $msg['content']
            ];
        }, $history);
    }

    /**
     * Format context as a string for logging
     */
    public function formatForPrompt(): string
    {
        $history = $this->getHistory();
        $formatted = "Recent conversation:\n";
        
        foreach ($history as $msg) {
            $formatted .= "{$msg['role']}: {$msg['content']}\n";
        }
        
        return $formatted;
    }

    /**
     * Clear conversation history
     */
    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }
}
