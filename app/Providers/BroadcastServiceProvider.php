<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Reverb doesn't use Broadcast::routes() like Pusher
        // It uses internal HTTP API with key/secret auth
        
        // Load channel authorization if needed for private channels
        require base_path('routes/channels.php');
    }
}
