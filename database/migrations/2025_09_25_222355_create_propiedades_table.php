<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesTable extends Migration
{
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            // Clave Primaria
            $table->id('id'); // id

            // Claves Foráneas (Asumiendo que referencian otras tablas)
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade'); // id_usuario
            $table->foreignId('id_tipo_propiedad')->constrained('tipos_propiedades')->onDelete('cascade'); // id_tipo_propiedad
            $table->foreignId('id_tipo_estancia')->constrained('tipos_estancia')->onDelete('cascade'); // id_tipo_estancia

            // Campos de texto y descriptivos
            $table->string('titulo', 150); // titulo
            $table->text('descripcion'); // descripcion
            $table->text('servicios_incluye')->nullable(); // servicios_incluye (Permito nulo)

            // Se usa DECIMAL(10, 7) para alta precisión, permitiendo valores negativos.
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);

            // Precio
            $table->unsignedDecimal('precio_pesos', 15, 2); // precio_pesos (Usamos unsignedDecimal para precios positivos)

            // Números
            $table->unsignedSmallInteger('numero_habitaciones'); // numero_habitaciones
            $table->unsignedSmallInteger('numero_baños'); // numero_baños

            // Timestamps de Laravel
            $table->timestamps(); // created_at y updated_at

            // Claves foráneas (si deseas relaciones explícitas)
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tipo_propiedad')->references('id')->on('tipo_propiedades')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
}
