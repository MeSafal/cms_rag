# Compact Format Update - Testing Guide

## What Changed

### 1. New Compact Format (Replaces JSON)
**Old Format (JSON):**
```json
{
  "table": "articles",
  "columns": ["title", "description"],
  "where": [{"column": "title", "operator": "LIKE", "value": "%about%"}],
  "limit": 5
}
```

**New Format (Compact Text):**
```
table: articles
columns: title, description
where: title LIKE %about%
limit: 5
```

**Benefits:**
- Fewer tokens (cheaper API calls)
- Easier for AI to generate correctly
- More human-readable
- No JSON parsing issues

### 2. Strict Intent Classification
AI must respond with ONLY ONE WORD:
- `casual`
- `db_needed`
- `blocked` 

No explanations, no punctuation, just the word.

## How to Test

### Step 1: Restart Queue Worker
```bash
# Stop current worker (Ctrl+C)
php artisan queue:work
```

### Step 2: Test Database Query

Ask: **"Tell me about your company"**

### Expected Log Output

```
Intent Classification: db_needed
Generating query params {"query":"..."}
AI Raw Response (compact format) {"response":"table: articles\ncolumns: ..."}
Parsed compact format successfully {"params":{"table":"articles",...}}
Auto-applied status filter
Query built successfully
Query execution result {"success":true,"count":2}
Formatting response with AI
```

### Success Indicators

✅ "Parsed compact format successfully"
✅ Response is in format: `table:\ncolumns:\nwhere:\nlimit:`
✅ No "Failed to parse" errors
✅ Query executes successfully

## Debug Mode Test

Add to `.env`:
```
RAG_DEBUG_MODE=true
```

Ask: **"What services do you offer?"**

**Expected Response:**
```
🔍 Debug Mode - Generated Query:

Table: articles  
Columns: title, description, alias
Where: [{"column":"title","operator":"LIKE","value":"%services%"}]
Limit: 5
```

## Compact Format Examples

### Example 1: Company Info
**Query:** "Tell me about this website"

**AI Should Return:**
```
table: articles
columns: title, description, alias
where: title LIKE %about%
limit: 5
```

### Example 2: Latest Blogs
**Query:** "Show me your latest blogs"

**AI Should Return:**
```
table: blogs
columns: title, description, author, alias
where: none
limit: 5
```

### Example 3: Specific Search
**Query:** "What services do you offer?"

**AI Should Return:**
```
table: articles
columns: title, description, alias
where: title LIKE %services%
limit: 5
```

## Troubleshooting

### Issue: "Missing 'table' in AI response"
**Solution:** AI didn't follow format. Check logs for actual response. The stricter prompt should fix this.

### Issue: WHERE conditions not parsing
**Solution:** Must be in format: `column OPERATOR value` separated by commas
Example: `title LIKE %value%, status = 1`

### Issue: Intent still coming back wrong
**Solution:** New strict rules with temp=0.0 should fix. AI MUST return only one word.

## What Happens Next

1. AI generates compact format
2. Parser converts to array format  
3. SafeQueryBuilder uses array to build SQL
4. Query executes with status=1 filter
5. Results formatted by AI
6. Response sent to user

## Token Savings

**JSON Format:** ~150-200 tokens
**Compact Format:** ~50-80 tokens

**Savings:** ~60-70% reduction in tokens!

This means:
- Faster responses
- Lower API costs
- Less chance of errors
