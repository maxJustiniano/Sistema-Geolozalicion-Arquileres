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
        Schema::create('filtro_propiedades', function (Blueprint $table) {
            // Claves Foráneas
            // id_propiedad (hace referencia a la tabla 'propiedades')
            $table->foreignId('id_propiedad')->constrained('propiedades')->onDelete('cascade');
            
            // id_tipo_filtro (hace referencia a la tabla 'tipos_filtros_propiedades')
            $table->foreignId('id_tipo_filtro')->constrained('tipos_filtros_propiedades')->onDelete('cascade');
            
            // Campo de aplicación (asumo que es un booleano o un texto descriptivo)
            $table->boolean('aplicacion')->default(true); // aplicación (Usamos boolean para indicar si aplica o no)

            // Clave primaria compuesta para asegurar la unicidad de la relación
            $table->primary(['id_propiedad', 'id_tipo_filtro']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filtro_propiedades');
    }
};