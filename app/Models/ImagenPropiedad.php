<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImagenPropiedad extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'imagenes_propiedades';

    /**
     * Los atributos que son asignables masivamente.
     */
    protected $fillable = [
        'id_propiedad',
        'url_imagen',
    ];

    // -------------------
    // RELACIONES
    // -------------------

    /**
     * Una imagen pertenece a una única Propiedad.
     */
    public function propiedad(): BelongsTo
    {
        // La clave foránea es 'id_propiedad'
        return $this->belongsTo(Propiedad::class, 'id_propiedad');
    }
}