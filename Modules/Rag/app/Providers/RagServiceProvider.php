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

        // Register embedding observers for auto-generation
        $this->registerEmbeddingObservers();
    }

    protected function registerEmbeddingObservers()
    {
        $allowedTables = config('rag.allowed_tables', []);

        foreach ($allowedTables as $table => $config) {
            $modelClass = $this->getModelClass($table);
            if ($modelClass && class_exists($modelClass)) {
                $observer = new \Modules\Rag\app\Observers\EmbeddingObserver(
                    $table,
                    $config['columns'],
                    $config['id_column']
                );
                $modelClass::observe($observer);
            }
        }
    }

    protected function getModelClass(string $table): ?string
    {
        $models = [
            'services' => \App\Models\Service::class,
            'teams' => \App\Models\Team::class,
            'coachings' => \App\Models\Coaching::class,
            'viso_articles' => \App\Models\VisoArticle::class,
            'blogs' => \App\Models\Blog::class,
        ];

        return $models[$table] ?? null;
    }
}
