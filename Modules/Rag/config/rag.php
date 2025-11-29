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
            'display_name' => 'company information',
        ],
        'blogs' => [
            'description' => 'News, updates, posts.',
            'columns' => ['title', 'description'],
            'id_column' => 'blogs_id',
            'display_name' => 'blog posts',
        ],
        'services' => [
            'description' => 'Service offerings and solutions.',
            'columns' => ['title', 'description'],
            'id_column' => 'id',
            'display_name' => 'services',
        ],
        'teams' => [
            'description' => 'Team members and their roles.',
            'columns' => ['name', 'email', 'phone', 'bio', 'role_name'],
            'id_column' => 'id',
            'display_name' => 'team members',
        ],
        'coachings' => [
            'description' => 'Test preparation coaching programs.',
            'columns' => ['title', 'description'],
            'id_column' => 'coachings_id',
            'display_name' => 'our programs',
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
    'api_key' => env('OPENROUTER_API_KEY', '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'),
    
    'embeddings' => [
        'model' => 'openai/text-embedding-3-small',
        'dimensions' => 1536,
        'similarity_threshold' => 0.10, // Lowered for better recall with synonyms
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

CRITICAL: DO NOT make claims about courses, classes, services, team members, or any specific offerings. 
If asked about these, say you need to check the database and cannot answer from memory alone.
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

            'format_response' => "You are an assistant for {app_name}. Answer the user's question using ONLY this data from the company's own database.
Data: {data}

CRITICAL RULES (IN ORDER OF PRIORITY):
1. **COUNTING QUESTIONS FIRST**: If asked 'how many', 'number of', 'count', or similar:
   - COUNT the items in the data above
   - Give the EXACT NUMBER first: 'We have X [items].' or 'There are X [items].'
   - THEN optionally list them
   
2. ONLY use information from the data above. DO NOT invent, assume, or add anything.

3. If the data doesn't contain what the user asked for, say 'I don't have that information in our database.'

4. If data includes contact info (email, phone), you MAY share it.

5. Include clickable links like: [Read more](URL)

6. Be concise, factual, and helpful.

7. NEVER make up course names, service names, or any other information.

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
