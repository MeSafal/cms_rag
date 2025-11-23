<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Models\RouteModel;  // Import your custom model

class StoreRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'routes:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store all named routes in the database, excluding file manager routes and routes without middleware';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get all registered routes
        $routes = Route::getRoutes();

        // Loop through the routes
        foreach ($routes as $route) {
            // Check if the route has a name, is not excluded, and has middleware attached
            if ($route->getName() && !$this->isExcludedRoute($route) && $this->hasMiddleware($route)) {
                // Store the route in the database
                RouteModel::updateOrCreate(
                    ['name' => $route->getName()],
                    ['uri' => $route->uri()]
                );
            }
        }

        $this->info('Named routes with middleware stored successfully!');
    }

    /**
     * Determine if a route should be excluded based on its name, URI, or other properties.
     *
     * @param \Illuminate\Routing\Route $route
     * @return bool
     */
    protected function isExcludedRoute($route)
    {
        // Get the route URI
        $uri = $route->uri();
        // Check if the URI starts with 'laravel-filemanager/'
        if (
            strpos($uri, 'laravel-filemanager/') === 0 ||
            strpos($uri, 'filemanager/') === 0 ||
            strpos($uri, 'storage/') === 0 ||
            strpos($uri, 'password') !== false ||
            strpos($uri, 'email') !== false
        ) {
            \Log::info('Checking route URI: ' . $uri);
            return true; // Exclude this route if it starts with 'laravel-filemanager/', 'filemanager/', or 'storage/'
        }
        return false;  // Include the route if not excluded
    }

    /**
     * Check if the route has any middleware attached (directly or via group).
     *
     * @param \Illuminate\Routing\Route $route
     * @return bool
     */
    protected function hasMiddleware($route)
    {

        // Get the route's action (the action contains middleware for the route group)
        $action = $route->getAction();

        // Check if there is a middleware assigned to this route or its group
        $middleware = $route->middleware();

        // Check if the route or route group has the 'auth' or 'guest' middleware
        $protectedMiddleware = ['auth', 'guest', 'auth:sanctum'];

        // If middleware exists, check for any of the 'protected' middlewares
        if (!empty($middleware)) {
            foreach ($middleware as $mw) {
                if (in_array($mw, $protectedMiddleware)) {
                    return true; // Middleware like 'auth', 'guest' or 'auth:sanctum' is present
                }
            }
        }

        // Check if the route has group-based middleware, i.e. in route groups like Breeze
        if (isset($action['middleware'])) {
            foreach ((array)$action['middleware'] as $mw) {
                if (in_array($mw, $protectedMiddleware)) {
                    return true;
                }
            }
        }

        return false; // If no 'auth' or 'guest' middleware found
    }
}
