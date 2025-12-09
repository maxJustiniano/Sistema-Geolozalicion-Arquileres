<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPropiedad extends Model
{
    use HasFactory;
    
    protected $table = 'tipos_propiedades';

    // Asegúrate de que este modelo tenga un campo 'slug' para el JS
    protected $fillable = [
        'tipo_propiedad', 
        'slug' // Debe coincidir con 'type' en tu JS (ej: 'casa', 'departamento')
    ];

    /**
     * Relación One-to-Many: Obtiene todas las propiedades de este tipo.
     */
    public function propiedades(): HasMany
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_propiedad');
    }
}