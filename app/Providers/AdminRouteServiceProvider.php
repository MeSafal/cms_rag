<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AdminRouteServiceProvider extends ServiceProvider
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
        Route::macro('adminResource', function (string $name, string $controller, array $options = []) {
            $routeName = $options['route_name'] ?? $name;
            $routeUrl = 'admin/' . $name;

            // Default routes configuration
            $defaultRoutes = [
                'index' => ['get', 'index'],
                'create' => ['get', 'form'],
                'store' => ['post', 'save'],
                'edit' => ['get', 'form', '{id}'],
                'update' => ['post', 'save', '{id}'],
                'view' => ['get', 'view', '{id}'],
                'delete' => ['post', 'delete', '{id}'],
                'alias' => ['post', 'alias', '{id}'],
                'publish' => ['post', 'publish', '{id}/{publish}'],
                'updateOrder' => ['post', 'updateOrder']
            ];

            // Merge with custom routes if provided
            $routes = array_merge(
                $defaultRoutes,
                $options['routes'] ?? []
            );

            // Register each route
            // Register each route
            foreach ($routes as $routeSuffix => $config) {
                // Skip if route is explicitly set to false
                if ($config === false) {
                    continue;
                }

                [$method, $action, $params] = array_pad($config, 3, '');

                // Build the URL
                if ($routeSuffix === 'index') {
                    // no suffix for index
                    $uri = "{$routeUrl}";
                } else {
                    $uri = "{$routeUrl}/{$routeSuffix}" . ($params ? "/{$params}" : '');
                }

                Route::$method($uri, [$controller, $action])
                    ->name("{$routeName}.{$routeSuffix}");
            }

        });
    }
}
