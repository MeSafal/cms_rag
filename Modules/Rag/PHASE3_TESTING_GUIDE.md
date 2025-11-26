# Phase 3 Testing Guide

## ✅ Completed Refactoring

### New Classes Created
1. **IntentHandler.php** - Handles intent classification and general responses (casual/blocked)
2. **DatabaseQueryHandler.php** - Handles database query generation and execution

### Modified Files
1. **ProcessOpenRouterMessage.php** - Now uses handler classes (cleaner code)
2. **config/rag.php** - Added debug_mode flag

## 🧪 How to Test Phase 3

### Step 1: Enable Debug Mode
Add to your `.env` file:
```env
RAG_DEBUG_MODE=true
```

Or set in config:
```php
// config/rag.php
'debug_mode' => true,
```

### Step 2: Clear Config Cache
```bash
php artisan config:clear
```

### Step 3: Start Services
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Queue worker
php artisan queue:work

# Terminal 3 (Optional): Reverb for WebSocket
php artisan reverb:start
```

### Step 4: Test Queries

Navigate to: `http://localhost:8000/chat`

**Test Query 1: Ask about website**
```
User: Tell me about this website
```

**Expected Response:**
```
🔍 Debug Mode - Generated Query:

{
  "table": "articles",
  "columns": ["title", "description"],
  "where": [
    {
      "column": "title",
      "operator": "LIKE",
      "value": "%about%"
    }
  ],
  "limit": 5
}
```

**Test Query 2: Ask about blogs**
```
User: Show me your latest blogs
```

**Expected Response:**
```json
{
  "table": "blogs",
  "columns": ["title", "description", "author"],
  "where": [],
  "limit": 5
}
```

**Test Query 3: Specific search**
```
User: What articles do you have about services?
```

**Expected Response:**
```json
{
  "table": "articles",
  "columns": ["title", "description"],
  "where": [
    {
      "column": "title",
      "operator": "LIKE",
      "value": "%services%"
    }
  ],
  "limit": 5
}
```

### Step 5: Validate JSON Structure

Check that each response includes:
- ✅ `table` - Must be "articles" or "blogs"
- ✅ `columns` - Array of column names
- ✅ `where` - Array of conditions (can be empty)
- ✅ `limit` - Number (should not exceed max_results from config)

### Step 6: Check Logs

View logs to see the process:
```bash
tail -f storage/logs/laravel.log
```

Look for:
```
[timestamp] Intent classified {"query":"...","intent":"db_needed"}
[timestamp] Generating query params {"query":"..."}
[timestamp] AI Raw Response for query generation {...}
[timestamp] Parsed Query Params {"params":{...}}
[timestamp] Debug mode active - returned raw JSON
```

### Step 7: Test Non-Database Queries

**Casual Query:**
```
User: Hi there
```
**Expected:** Normal greeting response (not JSON)

**Blocked Query:**
```
User: Write me a Python script
```
**Expected:** Polite redirection (not JSON)

## ✅ Success Criteria

Phase 3 is successful when:
- [x] Code is refactored into handler classes
- [ ] Debug mode returns JSON instead of executing queries
- [ ] JSON structure is correct for various query types
- [ ] Casual and blocked queries still work normally
- [ ] Logs show proper flow through handlers

## 🐛 Troubleshooting

### Issue: Still executing queries instead of returning JSON
**Solution:** 
1. Check `.env` has `RAG_DEBUG_MODE=true`
2. Run `php artisan config:clear`
3. Restart queue worker

### Issue: JSON is malformed
**Solution:** Check logs for "AI Raw Response" - AI might be adding markdown code blocks

### Issue: Getting errors
**Solution:** Check `storage/logs/laravel.log` for stack traces

## 🎯 Next Steps After Phase 3

Once JSON validation is complete:
1. Set `RAG_DEBUG_MODE=false`
2. Move to Phase 4: Query Execution
3. Verify database queries return actual data

## 📝 Notes

- Debug mode is controlled by `DatabaseQueryHandler->isDebugMode()`
- Intent classification still uses `RagService->classifyIntent()`
- All database logic is now in `DatabaseQueryHandler`
- All general response logic is now in `IntentHandler`
