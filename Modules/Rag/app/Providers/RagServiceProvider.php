<?php

namespace Modules\Rag\app\Providers;

use Illuminate\Support\ServiceProvider;

class RagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register module config
        $this->mergeConfigFrom(
            __DIR__.'/../../config/rag.php', 'rag'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'rag');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        
        // Publish config (optional)
        $this->publishes([
            __DIR__.'/../../config/rag.php' => config_path('rag.php'),
        ], 'rag-config');
        
        // Load broadcast channels
        if (file_exists($channelsPath = __DIR__ . '/../../routes/channels.php')) {
            require $channelsPath;
        }
    }
}
