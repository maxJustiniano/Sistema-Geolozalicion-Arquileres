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
        'id_tipo_estancia', // Nuevo campo de la migración
        'titulo',
        'descripcion',
        'servicios_incluye',
        'latitud',
        'longitud',
        'precio_pesos',
        'numero_habitaciones',
        'numero_baños',
        // Nota: Los servicios por checkbox deben manejarse en el controlador
        // y/o guardarse como un JSON o en una tabla de muchos a muchos.
    ];

    public function tipoPropiedad()
    {
        return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
    }
}
