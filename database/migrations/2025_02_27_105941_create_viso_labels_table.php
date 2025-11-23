<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisoLabelsTable extends Migration
{
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id('labels_id'); // Using id() for auto-incrementing primary key
            $table->string('en')->nullable();
            $table->string('alias')->nullable();
            $table->string('np')->nullable();
            $table->string('hi')->nullable();
            $table->integer('status')->default(1);
            $table->integer('display_order')->nullable();
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
            $table->timestamps(); // This will create created_at and updated_at fields
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
}
