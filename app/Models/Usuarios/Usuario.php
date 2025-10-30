<?php

namespace App\Models\Usuarios;
use Illuminate\Database\Eloquent\Model;

Class Usuario extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id_rol',
        'name',
        'email',
        'password'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function persona()
    {
        return $this->hasOne(Persona::class);
    }
}