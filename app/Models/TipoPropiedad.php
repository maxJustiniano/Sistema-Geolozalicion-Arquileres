<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    protected $table = 'tipo_propiedad';

    public $timestamps = false;

    protected $fillable = ['tipo_propiedad'];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_propiedad');
    }
}
