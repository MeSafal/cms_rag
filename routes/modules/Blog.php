<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;

Route::adminResource('blogs', BlogsController::class);
