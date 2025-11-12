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
        Schema::create('imagenes_propiedades', function (Blueprint $table) {
            // Clave Primaria
            $table->id(); // id

            // Clave Foránea
            // id_propiedad (Referencia a la tabla 'propiedades')
            // Se usa onDelete('cascade') para que al borrar una propiedad, se borren automáticamente todas sus imágenes.
            $table->foreignId('id_propiedad')->constrained('propiedades')->onDelete('cascade');

            // URL de la imagen
            // Usamos un campo de texto largo si la URL fuera muy extensa o un string de 2048 para URLs muy largas.
            $table->string('url_imagen', 2048); // url_imagen

            // Timestamps de Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_propiedades');
    }
};