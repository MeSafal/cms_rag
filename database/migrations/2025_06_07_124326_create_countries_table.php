<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id('countries_id'); // Using id() for auto-incrementing primary key
            $table->string('title')->nullable();
            $table->string('alias', 200)->nullable();
            $table->string('cover')->nullable();
            $table->string('thumb')->nullable();
            $table->text('description')->nullable();
            $table->text('entries')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('display_order')->nullable();
            $table->integer('status')->default(1);
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
            $table->timestamps(); // This will create created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
