<?php

namespace App\Models\Usuarios;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = ['nombre_rol'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}