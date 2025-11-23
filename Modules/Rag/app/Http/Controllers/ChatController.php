<?php

namespace Modules\Rag\app\Http\Controllers;

use Modules\Rag\app\Jobs\ProcessOpenRouterMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('rag::chat.chat');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Retrieve existing conversation from session (default to empty array)
        $conversation = session()->get('conversation', []);

        // Append current user message to the conversation
        $conversation[] = ['role' => 'user', 'content' => $request->message];

        // Only keep the last 10 conversation turns (5 exchanges)
        if (count($conversation) > 10) {
            $conversation = array_slice($conversation, -10);
        }

        // Save the updated conversation back to the session
        session(['conversation' => $conversation]);

        // Generate a unique cache key using the current message and a timestamp
        $cacheKey = 'chat_response_' . md5($request->message . now()->timestamp . uniqid());
        
        // Cache session ID for WebSocket broadcast
        Cache::put($cacheKey . '_session_id', session()->getId(), now()->addMinutes(5));

        // Dispatch the OpenRouter job with the complete conversation
        ProcessOpenRouterMessage::dispatch($conversation, $cacheKey);

        return response()->json([
            'status' => 'pending',
            'cache_key' => $cacheKey,
            'session_id' => session()->getId(), // For WebSocket channel subscription
        ]);
    }


    public function getResponse(Request $request)
    {
        $request->validate([
            'cache_key' => 'required|string',
        ]);

        $response = Cache::get($request->cache_key);

        if ($response) {
            // In getResponse() method
            if (Str::startsWith($request->cache_key, 'blog_tags_')) {
                return $this->handleBlogTagsResponse($request->cache_key, $response);
            } elseif (Str::startsWith($request->cache_key, 'blog_content_')) {
                return $this->handleBlogContentResponse($request->cache_key, $response);
            }

            // Keep existing chat handling below
            // Check if response is an array and contains a 'response' key
            $aiResponseMessage = is_array($response) && isset($response['response'])
                ? $response['response']
                : $response;

            // Append the AI's response to the conversation session
            $conversation = session()->get('conversation', []);
            $conversation[] = ['role' => 'assistant', 'content' => $aiResponseMessage];

            // Only keep the last 10 turns
            if (count($conversation) > 10) {
                $conversation = array_slice($conversation, -10);
            }
            session(['conversation' => $conversation]);

            return response()->json(['response' => $aiResponseMessage]);
        }

        return response()->json(['status' => 'pending']);
    }

    public function generateTags(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'initial_tags' => 'nullable|string',
        ]);

        $prompt = "Generate 5-7 comma-separated tags for a blog post about: " . $request->title;
        if ($request->initial_tags) {
            $prompt .= " with initial keywords: " . $request->initial_tags;
        }
        $prompt .= "\n\nReturn ONLY the comma-separated tags, nothing else.";

        $cacheKey = 'blog_tags_' . md5($request->title . now()->timestamp . uniqid());

        // Use OpenRouter for blog tag generation
        ProcessOpenRouterMessage::dispatch([
            ['role' => 'user', 'content' => $prompt]
        ], $cacheKey);

        return response()->json([
            'status' => 'pending',
            'cache_key' => $cacheKey
        ]);
    }

    public function generateContent(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'tags' => 'required|string',
        ]);

        $prompt = "Write a comprehensive blog post about: " . $request->title;
        $prompt .= "\nRelevant tags: " . $request->tags;
        $prompt .= "\n\nStructure the content with proper headings and paragraphs.";
        $prompt .= "\nReturn ONLY the formatted content without any additional text or markdown.";

        $cacheKey = 'blog_content_' . md5($request->title . now()->timestamp . uniqid());

        // Use OpenRouter for blog content generation
        ProcessOpenRouterMessage::dispatch([
            ['role' => 'user', 'content' => $prompt]
        ], $cacheKey);

        return response()->json([
            'status' => 'pending',
            'cache_key' => $cacheKey
        ]);
    }

    // public function getResponse(Request $request)
    // {
    //     $request->validate([
    //         'cache_key' => 'required|string',
    //     ]);

    //     $response = Cache::get($request->cache_key);

    //     if ($response) {
    //         // Handle different response types
    //         if (Str::startsWith($request->cache_key, 'blog_tags_')) {
    //             return $this->handleBlogTagsResponse($request->cache_key, $response);
    //         } elseif (Str::startsWith($request->cache_key, 'blog_content_')) {
    //             return $this->handleBlogContentResponse($request->cache_key, $response);
    //         }

    //         // Original chat handling
    //         $aiResponseMessage = is_array($response) && isset($response['response'])
    //             ? $response['response']
    //             : $response;

    //         $conversation = session()->get('conversation', []);
    //         $conversation[] = ['role' => 'ai', 'message' => $aiResponseMessage];

    //         if (count($conversation) > 5) {
    //             $conversation = array_slice($conversation, -5);
    //         }
    //         session(['conversation' => $conversation]);

    //         return response()->json(['response' => $aiResponseMessage]);
    //     }

    //     return response()->json(['status' => 'pending']);
    // }

    protected function handleBlogTagsResponse($cacheKey, $response)
    {
        $tags = is_array($response) ? $response['response'] : $response;

        // Clean up the response
        $tags = preg_replace('/^Tags?:?/i', '', $tags);
        $tags = preg_replace('/[^a-zA-Z0-9,\-\s]/', '', $tags);
        $tags = implode(', ', array_unique(array_filter(array_map('trim', explode(',', $tags)))));

        return response()->json([
            'status' => 'complete',
            'tags' => $tags
        ]);
    }

    protected function handleBlogContentResponse($cacheKey, $response)
    {
        $content = is_array($response) ? $response['response'] : $response;

        // Clean up the response
        $content = preg_replace('/^Content?:?/i', '', $content);
        $content = trim($content, " \t\n\r\0\x0B\"'`");

        return response()->json([
            'status' => 'complete',
            'content' => $content
        ]);
    }
}
