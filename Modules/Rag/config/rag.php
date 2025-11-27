<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Whitelist
    |--------------------------------------------------------------------------
    */
    'allowed_tables' => [
        'articles' => [
            'description' => 'Static pages (About Us, about company, about organization, about business). Identity info.',
            'columns' => ['title', 'description'],
            'id_column' => 'articles_id',
        ],
        'blogs' => [
            'description' => 'News, updates, posts.',
            'columns' => ['title', 'description'],
            'id_column' => 'blogs_id',
        ],
        'services' => [
            'description' => 'Service offerings and solutions.',
            'columns' => ['title', 'description'],
            'id_column' => 'id',
        ],
        'teams' => [
            'description' => 'Team members and their roles.',
            'columns' => ['name', 'email', 'phone', 'bio', 'role_name'],
            'id_column' => 'id',
        ],
        'coachings' => [
            'description' => 'Test preparation coaching programs.',
            'columns' => ['title', 'description'],
            'id_column' => 'coachings_id',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Query Limits
    |--------------------------------------------------------------------------
    */
    'max_results' => 5,
    'query_timeout' => 5, // seconds

    /*
    |--------------------------------------------------------------------------
    | Embeddings Configuration
    |--------------------------------------------------------------------------
    */
    'embeddings' => [
        'model' => 'openai/text-embedding-3-small',
        'dimensions' => 1536,
        'similarity_threshold' => 0.15, // Lowered to allow fuzzy matches/typos
        'top_k' => 20, // Number of similar embeddings to retrieve
    ],

    /*
    |--------------------------------------------------------------------------
    | Conversation Context
    |--------------------------------------------------------------------------
    */
    'conversation_history_limit' => 5,

    /*
    |--------------------------------------------------------------------------
    | Blocked Terms (Obvious Security Threats)
    |--------------------------------------------------------------------------
    */
    'obvious_blocked_terms' => [
        'password',
        'secret key',
        'env file',
        'aws key',
        'drop table',
        'delete from',
        'update set',
        'insert into',
    ],

    /*
    |--------------------------------------------------------------------------
    | AI Prompts
    |--------------------------------------------------------------------------
    */
    'prompts' => [
        // Intent classification
        'intent_classification' => "Classify user query into ONE category:

'casual': ONLY greetings (hi, hello, how are you, thanks, bye)
'db_needed': Queries about THIS company/website/organization - its content, services, team, information, About Us, mission, etc.
'blocked': EVERYTHING ELSE (coding help, general knowledge, essays, unrelated topics, etc.)

IMPORTANT:
- If user asks about 'managing director', 'ceo', 'founder', 'team', 'staff' -> 'db_needed'
- If user asks about 'code', 'programming', 'essay', 'math', 'history' -> 'blocked'
- If user asks 'who are you' -> 'casual'

Default to 'blocked' if unsure.
Respond with ONLY the category name.",

        // Casual response
        'casual_response' => "You are a friendly AI assistant for {app_name}. 
When asked who you are, introduce yourself naturally as the AI assistant for {app_name}.
Respond naturally and conversationally to greetings/messages.
Keep it brief (1-2 sentences).
Be warm and helpful.
Don't provide any sensitive technical or system details.",

        // Blocked response
        'blocked_response' => "You are an AI assistant for {app_name}.
The user asked something you cannot help with.
Politely redirect them to ask about the website instead.
Keep it brief (1 sentence).
Be friendly and helpful.
DO NOT list what you can't do or mention coding/essays/etc.",

        // Database query generation
        'query_generation' => "You are helping search a database. Available tables:

{tables_info}

User query: {query}

IMPORTANT: Understand the INTENT, not just literal words.

Examples:
- 'tell me about X' → search for 'about', 'about us', 'introduction', 'who we are'
- 'what is X' → search for 'about', 'introduction', 'overview'
- 'latest news' → search for 'news', 'update', 'latest'
- 'blog posts' → search blogs table
- 'services' → search for 'service', 'what we do', 'offer'

Respond in this EXACT format (2 lines only):
Line 1: table_name
Line 2: WHERE condition using LIKE (e.g., WHERE title LIKE '%about%' OR description LIKE '%about%')

Rules:
- ONLY use 'title' and 'description' columns
- Use CONTEXTUAL keywords, not literal entity names
- Use LIKE with % wildcards for fuzzy search
- Combine multiple keywords with OR if needed
- Keep it simple and effective",

        // Response formatting
        'format_response' => "Answer user's question using this data. Be natural and conversational.
Data: {data}

Include clickable links like: [Read more](URL)
Be concise and helpful.
You are assisting with information about {app_name}.",
    ],

    /*
    |--------------------------------------------------------------------------
    | Hardcoded Intent Keywords
    |--------------------------------------------------------------------------
    */
    'casual_phrases' => [
        'hi', 'hello', 'hey', 'namaste', 'good morning', 'good afternoon',
        'thanks', 'thank you', 'bye', 'goodbye',
        'who are you', 'what are you',
    ],

    'site_keywords' => [
        'about us', 'this site', 'this website', 'what is this', 'tell me about yourself',
        'your company', 'the company', 'your organization', 'your business'
    ],
];
