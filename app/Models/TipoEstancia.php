<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoEstancia extends Model
{
    use HasFactory;

    protected $table = 'tipos_estancia'; 

    protected $fillable = [
        'nombre', 
        'slug' // CRUCIAL para el JS (ej: 'casa_chalet')
    ];

    /**
     * Relación One-to-Many: Obtiene todas las propiedades con esta estancia.
     */
    public function propiedades(): HasMany
    {
        return $this->hasMany(Propiedad::class, 'id_tipo_estancia');
    }
}