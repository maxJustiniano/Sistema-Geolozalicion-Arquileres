<?php

namespace App\Models\Propiedades;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\TipoPropiedad;

class Propiedad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'propiedades';

    /**
     * The attributes that are mass assignable.
     * Estos campos coinciden con las columnas no-ID de la migración que diseñaste.
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 
        'tipo_propiedad_id', 
        'tipo_estancia_id',
        'titulo',
        'descripcion',
        'barrio', // Nuevo campo para 'neighborhood'
        'referencia_ubicacion', // Nuevo campo para 'reference'
        'latitud',
        'longitud',
        'precio',
        'habitaciones', // 'rooms'
        'banos', // 'bathrooms'
        'tiene_patio',
        'amueblado',
        'tiene_parking',
    ];

    /**
     * The attributes that should be cast.
     * Define el tipo de dato que Eloquent debe usar (especialmente para booleanos y números).
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'tiene_patio' => 'boolean',
        'amueblado' => 'boolean',
        'tiene_parking' => 'boolean',
    ];

    // -------------------
    // RELACIONES (RELATIONSHIPS)
    // -------------------

    /**
     * Obtiene el usuario que subió la propiedad (si usas la convención 'user_id').
     */
    public function user(): BelongsTo
    {
        // Asumiendo que el modelo User está en App\Models\User
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el tipo de propiedad (ej: 'casa', 'departamento').
     */
    public function tipoPropiedad(): BelongsTo
    {
        // Asumiendo que el modelo TipoPropiedad está en App\Models\TipoPropiedad
        return $this->belongsTo(TipoPropiedad::class);
    }

    /**
     * Obtiene el tipo de estancia (ej: 'casa_chalet', 'apartamento', 'alquiler').
     */
    public function tipoEstancia(): BelongsTo
    {
        // Asumiendo que el modelo TipoEstancia está en App\Models\TipoEstancia
        return $this->belongsTo(TipoEstancia::class);
    }

    /**
     * La relación Many-to-Many con los filtros.
     * Esto te permite hacer $propiedad->filtros->...
     */
    public function filtros(): BelongsToMany
    {
        // Usa la tabla pivote 'filtro_propiedad' y la clave foránea 'filtro_id'
        // Asumiendo que el modelo Filtro está en App\Models\Filtro
        return $this->belongsToMany(Filtro::class, 'filtro_propiedad', 'propiedad_id', 'filtro_id');
    }
}