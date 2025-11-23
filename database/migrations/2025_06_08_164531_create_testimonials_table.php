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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('testimonials_id'); // Using id() for auto-incrementing primary key
            $table->string('name')->nullable();
            $table->string('alias', 200)->nullable();
            $table->string('position')->nullable();
            $table->string('thumb')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('testimonials');
    }
};
