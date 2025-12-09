<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesTable extends Migration
{
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            // Relaciones con las tablas de lookup (Tipo y Estancia)
            $table->foreignId('id_tipo_propiedad')->constrained('tipos_propiedades');
            $table->foreignId('id_tipo_estancia')->constrained('tipos_estancia');

            $table->string('titulo', 150);
            $table->text('descripcion');
            $table->string('barrio')->nullable(); // neighborhood
            $table->string('referencia_ubicacion')->nullable(); // reference

            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);
            $table->decimal('precio_pesos', 15, 2)->unsigned(); // price

            $table->unsignedSmallInteger('numero_habitaciones'); // rooms
            $table->unsignedSmallInteger('numero_baños'); // bathrooms

            // Booleanos para mapeo directo del JS
            $table->boolean('tiene_patio')->default(false);
            $table->boolean('amueblado')->default(false);
            $table->boolean('tiene_parking')->default(false);

            $table->timestamps();
        });

        // TABLA PIVOTE: filtro_propiedades (Relación Many-to-Many)
        Schema::create('filtro_propiedades', function (Blueprint $table) {
            $table->id();
            // Claves foráneas sin primary key compuesta (usamos ID autoincremental)
            $table->foreignId('id_propiedad')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('id_tipo_filtro')->constrained('filtros')->onDelete('cascade');

            // Opcional: asegura que no se dupliquen los filtros en una misma propiedad
            $table->unique(['id_propiedad', 'id_tipo_filtro']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
}
