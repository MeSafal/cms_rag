# RAG Module Development Progress

> **Last Updated:** 2025-11-26  
> **Current Phase:** Phase 3 - Table Name & Condition Generation  
> **Status:** In Development

## 📋 Table of Contents
- [Overview](#overview)
- [Architecture](#architecture)
- [Development Phases](#development-phases)
- [Current Progress](#current-progress)
- [Key Files](#key-files)
- [Database Schema](#database-schema)
- [How to Resume Work](#how-to-resume-work)

---

## Overview

The RAG (Retrieval-Augmented Generation) module enables AI-powered chatbot to answer questions using database content. The system:
1. Classifies user intent
2. Generates database query parameters (JSON)
3. Executes safe queries
4. Formats results into natural language responses

**Goal:** Allow users to ask questions about website content and get AI-generated responses based on actual database data.

---

## Architecture

### Core Components

```
┌─────────────────────────────────────────────────────────────┐
│                         Frontend                            │
│                    (chat.blade.php)                         │
│              User asks: "Tell me about this site"           │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│                     ChatController                          │
│              Receives message, dispatches job               │
└──────────────────────────┬──────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────────┐
│              ProcessOpenRouterMessage (Job)                 │
│                    ┌──────────────┐                         │
│                    │ RagService   │                         │
│                    │  ├─ classifyIntent()                   │
│                    │  └─ processDBNeed()                    │
│                    └──────┬───────┘                         │
└───────────────────────────┼─────────────────────────────────┘
                            │
            ┌───────────────┴───────────────┐
            ▼                               ▼
    ┌───────────────┐              ┌────────────────┐
    │ OpenRouter AI │              │SafeQueryBuilder│
    │ (Generate SQL)│              │ (Execute Query)│
    └───────┬───────┘              └────────┬───────┘
            │                               │
            └───────────┬───────────────────┘
                        ▼
            ┌───────────────────────┐
            │   Database Results    │
            │   (articles/blogs)    │
            └───────────┬───────────┘
                        │
                        ▼
            ┌───────────────────────┐
            │ AI Formats Response   │
            │  (Natural Language)   │
            └───────────┬───────────┘
                        │
                        ▼
            ┌───────────────────────┐
            │  Broadcast to User    │
            │    (via WebSocket)    │
            └───────────────────────┘
```

### File Structure
```
Modules/Rag/
├── app/
│   ├── Events/
│   │   └── ChatMessageEvent.php          # WebSocket broadcasting
│   ├── Http/Controllers/
│   │   └── ChatController.php            # HTTP endpoints
│   ├── Jobs/
│   │   └── ProcessOpenRouterMessage.php  # Background processing
│   ├── Providers/
│   │   └── RagServiceProvider.php        # Service registration
│   └── Services/
│       ├── ConversationManager.php       # Session history management
│       ├── RagService.php                # Core RAG logic ⭐
│       └── SafeQueryBuilder.php          # Database query builder ⭐
├── config/
│   └── rag.php                           # Configuration ⭐
├── resources/views/chat/
│   └── chat.blade.php                    # Chat interface
├── routes/
│   ├── web.php                           # Routes
│   └── channels.php                      # WebSocket channels
└── tests/
    └── Unit/
        └── RagServiceTest.php            # Unit tests
```

---

## Development Phases

### ✅ Phase 1: Basic AI Response (COMPLETED)
**What:** Basic chat with OpenRouter AI  
**Files Modified:**
- `ProcessOpenRouterMessage.php`
- `ChatController.php`
- `ChatMessageEvent.php`
- `chat.blade.php`

**Status:** Working ✓

---

### ✅ Phase 2: General Query Handling (COMPLETED)
**What:** Intent classification and handling different query types  
**Features:**
- Casual conversations (greetings, thanks)
- Blocked queries (coding help, off-topic)
- Database-needed intent detection

**Files Modified:**
- `RagService.php` (classifyIntent method)
- `ConversationManager.php`

**Status:** Working ✓ (Can be improved later)

---

### 🔄 Phase 3: Table Name & Condition Generation (CURRENT)
**What:** AI generates JSON with table name and WHERE conditions  
**Goal:** Return JSON to frontend WITHOUT executing query yet

**Expected JSON Format:**
```json
{
  "table": "articles",
  "columns": ["title", "description"],
  "where": [
    {"column": "title", "operator": "LIKE", "value": "%about%"}
  ],
  "limit": 5
}
```

**Files to Modify:**
- [ ] `ProcessOpenRouterMessage.php` (add debug mode flag)
- [ ] `RagService.php` (option to return raw JSON)
- [ ] Frontend to display JSON

**Current Issue:** System generates JSON but immediately executes query. Need debug mode to only return JSON.

---

### ⏳ Phase 4: Query Execution from JSON
**What:** Execute database queries using SafeQueryBuilder  
**Dependency:** Phase 3 must be validated first

**Files:**
- `SafeQueryBuilder.php` (already implemented)
- Need to verify queries return correct data

---

### ⏳ Phase 5: Feed Data to AI & Generate Response
**What:** Format database results into natural language  
**Current State:** Partially implemented in `RagService.formatResponse()`

**Todo:**
- Verify URL generation
- Improve response templates
- Test with real data

---

### ⏳ Phase 6: Retry Logic
**What:** Auto-retry when query returns no results  
**Current State:** Basic retry in `processDBNeed()` method

**Improvements Needed:**
- Smarter retry strategies
- Broader search parameters
- Try alternative tables

---

### ⏳ Phase 7-11: Future Phases
See [task.md](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/task.md) for complete breakdown

---

## Current Progress

### What's Working ✅
1. AI responds to chat messages
2. Intent classification (casual/db_needed/blocked)
3. WebSocket real-time updates
4. Conversation history management
5. Safe query building with SQL injection prevention

### What's NOT Working ❌
1. **Main Issue:** Not responding well with database data
2. No validation if query returns actual results
3. URL generation may not match site structure
4. No status filtering (published vs draft)
5. Limited debugging capabilities

### What Needs to Be Done Next 🎯
1. Add debug mode to see generated JSON
2. Test query generation without execution
3. Verify database has actual data
4. Fix URL patterns for articles/blogs

---

## Key Files

### ⭐ RagService.php
**Purpose:** Core RAG logic  
**Key Methods:**
- `classifyIntent()` - Determines query type (casual/db_needed/blocked)
- `processDBNeed()` - Generates database query parameters using AI
- `formatResponse()` - Formats database results into natural language
- `callAI()` - Makes OpenRouter API calls

**Location:** `app/Services/RagService.php`

---

### ⭐ SafeQueryBuilder.php
**Purpose:** Build and execute safe database queries  
**Key Methods:**
- `buildQuery()` - Creates Laravel query from JSON parameters
- `executeQuery()` - Runs query and returns results
- `validateTable()` - Security check for allowed tables
- `getAllowedTablesSchema()` - Returns schema description for AI

**Location:** `app/Services/SafeQueryBuilder.php`

---

### ⭐ config/rag.php
**Purpose:** Configuration for allowed tables and limits  
**Current Config:**
```php
'allowed_tables' => [
    'articles' => [
        'description' => 'Static pages (About Us, Services)',
        'columns' => ['title', 'description', 'alias', ...],
        'id_column' => 'articles_id',
    ],
    'blogs' => [
        'description' => 'News, updates, posts',
        'columns' => ['title', 'description', 'author', ...],
        'id_column' => 'blogs_id',
    ],
],
'max_results' => 5,
'max_retries' => 2,
```

**Location:** `config/rag.php`

---

### ProcessOpenRouterMessage.php
**Purpose:** Background job that processes chat messages  
**Flow:**
1. Get user query
2. Classify intent
3. If db_needed: call `processDBNeed()`
4. Cache response
5. Broadcast via WebSocket

**Location:** `app/Jobs/ProcessOpenRouterMessage.php`

---

## Database Schema

### Articles Table
```sql
CREATE TABLE articles (
    articles_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    subtitle VARCHAR(255),
    alias VARCHAR(200),
    description TEXT,
    status INT DEFAULT 1,  -- 1=published, 0=draft
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Blogs Table
```sql
CREATE TABLE blogs (
    blogs_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    subtitle VARCHAR(255),
    author VARCHAR(255),
    alias VARCHAR(200),
    description TEXT,
    status INT DEFAULT 1,  -- 1=published, 0=draft
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Note:** Both tables use custom ID columns (`articles_id`, `blogs_id`) instead of standard `id`

---

## How to Resume Work

### For Phase 3 (Current Phase)

#### 1. Verify Database Has Data
```bash
php artisan tinker
>>> DB::table('articles')->count()
>>> DB::table('blogs')->count()
```

#### 2. Add Debug Mode
**File:** `app/Jobs/ProcessOpenRouterMessage.php`

Add after line 84 (in the `db_needed` block):
```php
// DEBUG MODE: Return raw JSON
if (config('rag.debug_mode', false)) {
    $jsonParams = $ragService->generateQueryJSON($query, $context);
    $responseContent = "Debug - Generated Query:\n" . json_encode($jsonParams, JSON_PRETTY_PRINT);
    // Skip query execution
} else {
    // Normal flow: execute query
    $responseContent = $ragService->processDBNeed($query, $context);
}
```

#### 3. Add Config Flag
**File:** `config/rag.php`

Add:
```php
'debug_mode' => env('RAG_DEBUG_MODE', false),
```

#### 4. Enable Debug Mode
Add to `.env`:
```
RAG_DEBUG_MODE=true
```

#### 5. Test
1. Start services:
   ```bash
   php artisan serve
   php artisan queue:work
   ```
2. Go to `/chat`
3. Ask: "Tell me about this website"
4. Should see JSON response instead of database data

#### 6. Once JSON is Validated
- Set `RAG_DEBUG_MODE=false`
- Proceed to Phase 4

---

### For Future Phases

See [task.md](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/task.md) for detailed checklist of each phase.

---

## Environment Setup

### Required Services
1. Laravel server: `php artisan serve`
2. Queue worker: `php artisan queue:work`
3. Reverb server (optional for WebSocket): `php artisan reverb:start`

### Required ENV Variables
```env
OPENROUTER_API_KEY=your_key_here
BROADCAST_CONNECTION=reverb
REVERB_APP_KEY=qskwvj5qfsqqjsibjws6
```

---

## Troubleshooting

### No AI Response
- Check `storage/logs/laravel.log`
- Verify queue worker is running
- Check OpenRouter API key is valid

### Empty Database Results
- Run: `DB::table('articles')->where('status', 1)->get()`
- Check if status filtering is needed
- Verify data exists

### WebSocket Not Working
- Check Reverb server is running
- Verify `.env` WebSocket configuration
- Fallback to polling should work

---

## Next Developer Notes

**If you're picking up this project:**
1. Read this README completely
2. Check [task.md](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/task.md) for current phase
3. Review the 3 key files: `RagService.php`, `SafeQueryBuilder.php`, `rag.php`
4. Test basic chat first: `/chat`
5. Then enable debug mode and test query generation

**Quick Start:**
```bash
# 1. Install dependencies
composer install

# 2. Start services
php artisan serve
php artisan queue:work

# 3. Test chat
# Navigate to http://localhost:8000/chat
```

---

## Resources

- [RAG Module README](README.md) - Original module documentation
- [Task List](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/task.md) - Current task breakdown
- [Implementation Plan](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/implementation_plan.md) - Initial analysis

---

**Remember:** Work in phases. Don't skip ahead. Validate each phase before moving to next!
