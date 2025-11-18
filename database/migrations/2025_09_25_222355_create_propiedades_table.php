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
            $table->id('id');

            // Claves Foráneas
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_tipo_propiedad')->constrained('tipos_propiedades')->onDelete('cascade');
            $table->foreignId('id_tipo_estancia')->constrained('tipos_estancia')->onDelete('cascade');

            // Campos de texto y descriptivos
            $table->string('titulo', 150);
            $table->text('descripcion');
            $table->text('servicios_incluye')->nullable();

            // Ubicación (Latitud y Longitud)
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);

            // Precio (CAMBIO AQUÍ: Usamos decimal()->unsigned())
            $table->decimal('precio_pesos', 15, 2)->unsigned(); // precio_pesos para valores positivos

            // Números
            $table->unsignedSmallInteger('numero_habitaciones');
            $table->unsignedSmallInteger('numero_baños');

            // Timestamps de Laravel
            $table->timestamps();

            // Claves foráneas (si deseas relaciones explícitas, ya definidas con foreignId)
            // NOTA: Estas líneas son redundantes si usaste foreignId()->constrained(), pero las mantengo por si la tabla 'tipo_propiedades' se llama diferente.
            // Asegúrate que tu tabla sea 'users' y 'tipo_propiedades' (o 'tipos_propiedades').
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tipo_propiedad')->references('id')->on('tipo_propiedades')->onDelete('cascade');
            // Nota: Es posible que necesites ajustar el nombre de la tabla de referencia a 'tipos_propiedades' si así lo definiste.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
}