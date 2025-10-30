<?php

namespace App\Models\Propiedades;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    protected $table = 'tipo_propiedades';

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_propiedad');
    }
}