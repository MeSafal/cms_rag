<?php

use Illuminate\Contracts\Console\Kernel;
use App\Models\Team;
use Modules\Rag\app\Observers\EmbeddingObserver;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

// Load the RAG config manually if needed, or rely on app boot
$config = config('rag.allowed_tables.teams');

if (!$config) {
    echo "Error: 'teams' table not configured in rag.php\n";
    exit(1);
}

echo "Re-indexing teams...\n";

$teams = Team::all();
$count = $teams->count();
echo "Found $count team members.\n";

$observer = new EmbeddingObserver('teams', $config['columns'], $config['id_column']);

foreach ($teams as $team) {
    echo "Processing: {$team->name} ({$team->role_name})\n";
    // Manually trigger the embedding generation logic
    // We can't just call $observer->updated($team) because that expects an event
    // But we can use the same logic:
    
    $data = [];
    foreach ($config['columns'] as $column) {
        if ($column === 'role_name') {
             $data[$column] = $team->role_name;
        } elseif (isset($team->$column)) {
            $data[$column] = $team->$column;
        }
    }
    
    // Dispatch the job directly
    \App\Jobs\GenerateModelEmbedding::dispatch(
        'teams',
        $team->id,
        $data,
        $config['columns']
    );
}

echo "All jobs dispatched. Run 'php artisan queue:work' to process them.\n";
