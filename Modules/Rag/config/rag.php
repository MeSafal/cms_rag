<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Whitelist
    |--------------------------------------------------------------------------
    |
    | Define which tables the RAG system can access. Only these tables
    | will be queryable by the AI assistant.
    |
    */
    'allowed_tables' => [
        'articles' => [
            'description' => 'Static pages (About Us, Services). Identity info.',
            'columns' => ['title', 'description', 'alias', 'created_at', 'updated_at'],
            'id_column' => 'articles_id',
        ],
        'blogs' => [
            'description' => 'News, updates, posts.',
            'columns' => ['title', 'description', 'alias', 'author', 'created_at', 'updated_at'],
            'id_column' => 'blogs_id',
        ],
        'countries' => [
            'description' => 'countries, country information, number of countries with count() function',
            'columns' => ['title', 'description'],
            'id_column' => 'countries_id',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Query Limits
    |--------------------------------------------------------------------------
    */
    'max_results' => 5,
    'max_retries' => 2,
    'query_timeout' => 5, // seconds

    /*
    |--------------------------------------------------------------------------
    | Debug Mode
    |--------------------------------------------------------------------------
    | When enabled, returns raw JSON query parameters instead of executing
    | database queries. Useful for Phase 3 testing.
    */
    'debug_mode' => env('RAG_DEBUG_MODE', false),

    /*
    |--------------------------------------------------------------------------
    | Conversation Context
    |--------------------------------------------------------------------------
    */
    'conversation_history_limit' => 5, // Last N exchanges to keep
];
