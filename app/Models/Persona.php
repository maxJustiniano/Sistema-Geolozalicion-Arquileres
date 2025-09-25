<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['id', 'nombre', 'apellido', 'telefono', 'email'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
