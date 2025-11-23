<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlidersController;

Route::adminResource('sliders', SlidersController::class);
