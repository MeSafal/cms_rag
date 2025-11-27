<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

$embedding = DB::table('data_embeddings')
    ->where('table_name', 'teams')
    ->where('entity_id', 1) // Gokul Subedi
    ->first();

if ($embedding) {
    echo "Found embedding for Team ID 1:\n";
    echo "Raw Text: " . $embedding->raw_text . "\n";
    if (str_contains($embedding->raw_text, 'Managing Director')) {
        echo "SUCCESS: Role 'Managing Director' is present.\n";
    } else {
        echo "FAILURE: Role 'Managing Director' is MISSING.\n";
    }
} else {
    echo "No embedding found for Team ID 1.\n";
}
