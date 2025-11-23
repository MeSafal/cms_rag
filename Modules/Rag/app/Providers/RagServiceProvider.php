<?php

namespace Modules\Rag\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'rag');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        
        // Load broadcast channels
        if (file_exists($channelsPath = __DIR__ . '/../../routes/channels.php')) {
            require $channelsPath;
        }
    }
}
