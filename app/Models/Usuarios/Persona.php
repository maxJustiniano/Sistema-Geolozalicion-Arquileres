<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}