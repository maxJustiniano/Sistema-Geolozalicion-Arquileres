<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPropiedadTable extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_propiedad', function (Blueprint $table) {
            $table->id(); // id INT auto-increment
            $table->string('tipo_propiedad', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_propiedad');
    }
}
