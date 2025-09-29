<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadesTable extends Migration
{
    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id(); // id BIGINT auto-increment
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_tipo_propiedad');
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->date('fecha_publicacion');
            $table->timestamps(); // created_at y updated_at

            // Claves foráneas (si deseas relaciones explícitas)
            $table->foreign('id_usuario')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_tipo_propiedad')->references('id')->on('tipo_propiedad')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
}
