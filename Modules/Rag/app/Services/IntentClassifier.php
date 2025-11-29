<?php

namespace Modules\Rag\app\Services;

use Illuminate\Support\Facades\Log;

class IntentClassifier
{
    /**
     * Classify user query into casual, db_needed, or blocked
     */
    public function classify(string $query, array $conversationContext = []): string
    {
        if ($this->isObviouslyBlocked($query)) {
            return 'blocked';
        }

        $lowerQuery = strtolower(trim($query));
        $appName = strtolower(config('app.name', ''));
        
        // Hardcoded greetings and identity questions from config
        $casualPhrases = config('rag.casual_phrases', []);
        
        // Exact match for greetings
        if (in_array($lowerQuery, $casualPhrases)) {
            Log::info("Intent Classification (hardcoded - exact match): casual");
            return 'casual';
        }
        
        // Partial match for greetings like "hello there", "hi there"
        foreach ($casualPhrases as $phrase) {
            if (str_starts_with($lowerQuery, $phrase . ' ')) {
                Log::info("Intent Classification (hardcoded - partial match '$phrase'): casual");
                return 'casual';
            }
        }
        
        // Hardcoded site-related keywords from config (PRIORITY OVER CONTEXT)
        $siteKeywords = config('rag.site_keywords', []);
        foreach ($siteKeywords as $keyword) {
            if (str_contains($lowerQuery, $keyword)) {
                Log::info("Intent Classification (hardcoded - site keyword '$keyword'): db_needed");
                return 'db_needed';
            }
        }
        
        // Check if query mentions the app name
        if ($appName && str_contains($lowerQuery, $appName)) {
            Log::info("Intent Classification (hardcoded - app name '$appName'): db_needed");
            return 'db_needed';
        }

        // Check for team/company questions
        $companyKeywords = ['managing director', 'ceo', 'founder', 'team', 'staff', 'employees', 'boss', 'director', 'manager'];
        foreach ($companyKeywords as $keyword) {
            if (str_contains($lowerQuery, $keyword)) {
                Log::info("Intent Classification (hardcoded - company keyword '$keyword'): db_needed");
                return 'db_needed';
            }
        }
        
        // Check for course/class/training/coaching questions - CRITICAL FOR ACCURACY
        $courseKeywords = ['class', 'classes', 'course', 'courses', 'training', 'workshop', 'workshops', 'coaching', 'program', 'programs', 'teach', 'learn', 'service', 'services', 'offering', 'offerings'];
        foreach ($courseKeywords as $keyword) {
            if (str_contains($lowerQuery, $keyword)) {
                Log::info("Intent Classification (hardcoded - course keyword '$keyword'): db_needed");
                return 'db_needed';
            }
        }
        
        // Check for action requests that imply database lookup
        $actionKeywords = ['check', 'show me', 'tell me', 'list', 'search', 'find', 'display', 'what are'];
        foreach ($actionKeywords as $keyword) {
            if (str_contains($lowerQuery, $keyword)) {
                Log::info("Intent Classification (hardcoded - action keyword '$keyword'): db_needed");
                return 'db_needed';
            }
        }
        
        // REMOVED: hasRecentAnswer check
        // Reason: If user asks about classes/services, we should ALWAYS check DB to be safe.
        // Relying on context often leads to "I can't check DB" responses in casual mode.

        // Fallback to AI classification
        return $this->classifyWithAI($query, $conversationContext);
    }

    /**
     * Check if query was recently answered in conversation context
     */
    protected function hasRecentAnswer(string $query, array $context): bool
    {
        if (empty($context)) {
            return false;
        }

        // Get last few turns
        $recentTurns = array_slice($context, -4);
        
        foreach ($recentTurns as $turn) {
            if (!isset($turn['role']) || !isset($turn['content'])) {
                continue;
            }
            
            // Look for assistant responses that answered this query
            if ($turn['role'] === 'assistant') {
                // Ignore short responses, "not found" messages, or polite refusals
                $content = $turn['content'];
                if (strlen($content) < 100 || 
                    str_contains($content, 'No information found') ||
                    str_contains($content, "I'm sorry, but I can't") ||
                    str_contains($content, "I don't have specific information")
                ) {
                    continue;
                }
                
                // If assistant gave a substantial answer recently
                // and user is asking similar question, use context
                return true;
            }
        }
        
        return false;
    }

    /**
     * Use AI to classify intent
     */
    protected function classifyWithAI(string $query, array $conversationContext): string
    {
        Log::info("Intent Classification Query: $query");
        
        $systemPrompt = config('rag.prompts.intent_classification');

        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        
        // Add conversation context
        if (!empty($conversationContext)) {
            $messages = array_merge($messages, array_slice($conversationContext, -4));
        }
        
        $messages[] = ['role' => 'user', 'content' => $query];

        $ragService = app(RagService::class);
        $response = $ragService->callAI($messages, 0.1, 20);
        $intent = trim(strtolower($response));
        
        Log::info("Intent Classification: $intent");
        
        // Validate and default to blocked
        if (!in_array($intent, ['casual', 'db_needed', 'blocked'])) {
            $intent = 'blocked';
        }
        
        return $intent;
    }

    /**
     * Check for obviously blocked queries using config
     */
    protected function isObviouslyBlocked(string $query): bool
    {
        $blockedTerms = config('rag.obvious_blocked_terms', []);
        
        foreach ($blockedTerms as $term) {
            if (stripos($query, $term) !== false) {
                return true;
            }
        }
        
        return false;
    }
}
