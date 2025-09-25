<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // ← nombre exacto de la tabla
    public $timestamps = false; // si no usás created_at y updated_at

    protected $fillable = ['id_rol', 'id_persona', 'nombre', 'contraseña', 'fecha_registro'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_usuario');
    }
}
