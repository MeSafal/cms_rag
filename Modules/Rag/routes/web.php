<?php

use Illuminate\Support\Facades\Route;
use Modules\Rag\app\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Rag Module Routes
|--------------------------------------------------------------------------
|
| All chat and RAG-related routes are registered here.
|
*/

// Chat routes
Route::middleware('web')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/response', [ChatController::class, 'getResponse'])->name('chat.response');

    // AI Content Generation routes
    Route::post('/generate-tags', [ChatController::class, 'generateTags'])->name('chat.generate-tags');
    Route::post('/generate-content', [ChatController::class, 'generateContent'])->name('chat.generate-content');
});
