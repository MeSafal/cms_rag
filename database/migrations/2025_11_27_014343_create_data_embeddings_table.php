<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_embeddings', function (Blueprint $table) {
            $table->id();
            $table->string('table_name', 50)->index();
            $table->unsignedInteger('entity_id');
            $table->string('column_name', 50);
            $table->text('raw_text');
            $table->json('embedding'); // vector as JSON array
            $table->timestamps();
            
            // Composite index for fast lookups
            $table->index(['table_name', 'entity_id'], 'idx_table_entity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_embeddings');
    }
};
