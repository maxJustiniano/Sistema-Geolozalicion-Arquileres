<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    protected $table = 'propiedades';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_publicacion',
        'id_usuario',
        'id_tipo_propiedad',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function tipoPropiedad()
    {
        return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
    }
}
