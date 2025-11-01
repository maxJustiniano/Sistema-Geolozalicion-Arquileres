<?php

namespace App\Models\Propiedades;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Persona;
use App\Models\Propiedades\TipoPropiedad;

class Propiedad extends Model
{
     protected $table = 'propiedades';
     
    protected $fillable = [
        'id_usuario',
        'id_tipo_propiedad',
        'titulo',
        'descripcion',
        'fecha_publicacion',
    ];

    public function usuario()
    {
        return $this->belongsTo(Persona::class, 'id_usuario');
    }

    public function tipoPropiedad()
    {
        return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
    }
}
