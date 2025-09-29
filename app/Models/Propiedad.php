<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function tipo()
    {
        return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
    }
}
