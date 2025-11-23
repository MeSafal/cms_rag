<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialsController;

Route::adminResource('testimonials', TestimonialsController::class);
