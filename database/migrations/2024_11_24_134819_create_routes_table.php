<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // database/migrations/xxxx_xx_xx_xxxxxx_create_routes_table.php

    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Route name
            $table->string('uri');            // Route URI
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }

};
