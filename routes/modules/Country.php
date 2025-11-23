<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountriesController;

Route::adminResource('countries', CountriesController::class);
