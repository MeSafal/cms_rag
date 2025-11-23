<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachingsController;

Route::adminResource('coachings', CoachingsController::class);
