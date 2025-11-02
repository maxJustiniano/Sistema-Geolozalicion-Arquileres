<?php

namespace App\Models\IdentidadUsuario;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = ['nombre_rol'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}