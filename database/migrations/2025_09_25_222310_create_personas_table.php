<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id(); // id INT auto-increment
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('email', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
}

