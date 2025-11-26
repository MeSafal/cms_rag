# RAG Module - Quick Reference

## 🎯 Current Status
- **Phase:** 3 - Table Name & Condition Generation
- **Status:** Need to add debug mode to return JSON without executing queries

## 📝 Key Documents
1. **[task.md](file:///C:/Users/Prapty/.gemini/antigravity/brain/36650fba-07c0-4431-9313-0f8af6dd59f6/task.md)** - Phase-wise task checklist
2. **[RAG_DEVELOPMENT_README.md](file:///e:/installed/xampps/htdocs/cms_rag/Modules/Rag/RAG_DEVELOPMENT_README.md)** - Complete development guide

## 🚀 Quick Start Commands
```bash
# Start server
php artisan serve

# Start queue worker
php artisan queue:work

# Test chat
# Go to: http://localhost:8000/chat
```

## 📂 Key Files to Modify (Phase 3)
1. `Modules/Rag/app/Jobs/ProcessOpenRouterMessage.php` - Add debug mode
2. `Modules/Rag/app/Services/RagService.php` - Add generateQueryJSON method
3. `Modules/Rag/config/rag.php` - Add debug_mode flag

## 🔍 Test Database
```bash
php artisan tinker
>>> DB::table('articles')->count()
>>> DB::table('blogs')->count()
```

## 📋 All Phases Overview
1. ✅ Basic AI Response
2. ✅ General Query Handling  
3. 🔄 **Table Name & Condition Generation (CURRENT)**
4. ⏳ Query Execution
5. ⏳ Feed Data to AI
6. ⏳ Retry Logic
7. ⏳ Refinement
8. ⏳ Optimization
9. ⏳ Dynamic Configuration
10. ⏳ Deploy & Test
11. ⏳ Continuous Improvement

## 🎨 Architecture Flow
```
User Query → ChatController → ProcessOpenRouterMessage Job
    → RagService.classifyIntent()
    → RagService.processDBNeed() generates JSON
    → SafeQueryBuilder executes query
    → Results sent to AI for formatting
    → Response broadcast via WebSocket
```

## 🧪 Next Steps (Phase 3)
1. Add `RAG_DEBUG_MODE=true` to .env
2. Modify ProcessOpenRouterMessage.php to check debug flag
3. Return raw JSON without executing query
4. Test with: "Tell me about this website"
5. Validate JSON structure matches expected format
6. Once validated, move to Phase 4

## 📖 Full Documentation
Read [RAG_DEVELOPMENT_README.md](file:///e:/installed/xampps/htdocs/cms_rag/Modules/Rag/RAG_DEVELOPMENT_README.md) for complete details.
