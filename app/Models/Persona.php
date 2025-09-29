<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email'
    ];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_usuario');
    }
}
