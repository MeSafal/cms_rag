<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

Route::adminResource('articles', ArticlesController::class);

