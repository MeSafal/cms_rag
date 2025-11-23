<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

Route::post('v1/login', [ApiController::class, 'login']);
