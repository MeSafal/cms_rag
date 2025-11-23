<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisoSettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id('setting_id'); // Using id() for auto-incrementing primary key
            $table->string('switch_state')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('selected_color')->nullable();
            $table->string('custom_color', 200)->nullable();
            $table->integer('status')->default(1);
            $table->integer('display_order')->nullable();
            $table->string('createdby')->nullable();
            $table->string('updatedby')->nullable();
            $table->timestamps(); // This will create created_at and updated_at fields
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}
