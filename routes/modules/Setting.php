<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

Route::adminResource('settings', SettingsController::class,[
    'routes' =>[
        // 'edit' => false,
        'edit' => ['get', 'edit'],
        'toggle' => ['post', 'toggleTheme']
    ]
]);
