<?php

namespace App\Models\IdentidadUsuario;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'dni',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}