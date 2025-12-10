<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importación necesaria

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        // ... (resto de fillable)
        'id_usuario', 
        'id_tipo_propiedad', 
        'id_tipo_estancia',
        'titulo',
        'descripcion',
        'barrio',
        'referencia_ubicacion',
        'latitud',
        'longitud',
        'precio_pesos',
        'numero_habitaciones',
        'numero_baños',
        'tiene_patio',
        'amueblado',
        'tiene_parking',
    ];

    /**
     * Casteo de atributos para asegurar tipos correctos.
     */
    protected $casts = [
        // ... (resto de casts)
        'precio_pesos' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'tiene_patio' => 'boolean',
        'amueblado' => 'boolean',
        'tiene_parking' => 'boolean',
    ];

    // -------------------
    // RELACIONES
    // -------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function tipoPropiedad(): BelongsTo
    {
        return $this->belongsTo(TipoPropiedad::class, 'id_tipo_propiedad');
    }

    public function tipoEstancia(): BelongsTo
    {
        return $this->belongsTo(TipoEstancia::class, 'id_tipo_estancia');
    }

    /**
     * Relación One-to-Many: Una propiedad puede tener muchas imágenes.
     */
    public function imagenes(): HasMany
    {
        // La clave foránea en imagenes_propiedades es 'id_propiedad'
        return $this->hasMany(ImagenPropiedad::class, 'id_propiedad');
    }

    /**
     * Relación Many-to-Many con los filtros.
     */
    public function filtros(): BelongsToMany
    {
        return $this->belongsToMany(
            Filtro::class, 
            'filtro_propiedades', 
            'id_propiedad', 
            'id_tipo_filtro'
        );
    }
}