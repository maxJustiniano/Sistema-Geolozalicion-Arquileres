<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filtro extends Model
{
    use HasFactory;
    
    // La tabla de la base de datos que este modelo representa
    protected $table = 'filtros'; 

    // Campos que permiten asignación masiva
    protected $fillable = [
        'nombre', 
        'slug', // Es crucial, ya que es el valor que usa el JS (ej: 'wifi_gratis')
        'categoria', // Es crucial, ya que es el valor que usa el JS (ej: 'facility', 'roomService')
    ]; 

    /**
     * Relación Many-to-Many: Obtiene las propiedades que tienen este filtro.
     */
    public function propiedades(): BelongsToMany
    {
        // 'filtro_propiedades' es la tabla pivote
        return $this->belongsToMany(
            Propiedad::class, 
            'filtro_propiedades', 
            'id_tipo_filtro', // Clave local en la tabla pivote
            'id_propiedad'    // Clave relacionada en la tabla pivote
        );
    }
}