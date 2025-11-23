<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Http\Controllers\FrontendController;

// Chat routes moved to Rag module

Route::get('/welcome', function () {
    // return view('frontend.temp1.home');
    return view('welcome');
});

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');


Route::get('/{path}', [FrontendController::class, 'loadPages'])->where('path', '.*')->name('content.dynamic');
