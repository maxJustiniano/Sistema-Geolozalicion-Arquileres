<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    protected $table = 'tipo_propiedad'; // ← nombre exacto de la tabla
    public $timestamps = false; // si no usás created_at y updated_at

    protected $fillable = ['tipo_propiedad'];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_propiedad');
    }
}
