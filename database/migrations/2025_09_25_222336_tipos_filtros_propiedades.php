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
        Schema::create('tipos_filtros_propiedades', function (Blueprint $table) {
            $table->id(); // id
            $table->string('filtro_propiedad', 100)->unique(); // Filtro_propiedad (convertido a snake_case)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_filtros_propiedades');
    }
};