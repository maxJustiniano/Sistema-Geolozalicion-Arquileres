<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'id_usuario', 
        'id_tipo_propiedad', 
        'id_tipo_estancia',
        'titulo',
        'descripcion',
        'barrio', // Necesario para 'neighborhood'
        'referencia_ubicacion', // Necesario para 'reference'
        'latitud',
        'longitud',
        'precio_pesos', // Tu nombre de columna
        'numero_habitaciones', // Tu nombre de columna
        'numero_baños', // Tu nombre de columna
        'tiene_patio', // Si lo incluyes en la BD
        'amueblado',
        'tiene_parking',
    ];

    /**
     * Casteo de atributos para asegurar tipos correctos.
     */
    protected $casts = [
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