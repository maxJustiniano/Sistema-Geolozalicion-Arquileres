<?php

namespace App\Models\IdentidadUsuario;

use Illuminate\Database\Eloquent\Model;

class UsuariosViews extends Model
{
    // Indicar a Eloquent que use el nombre de la Vista SQL
    protected $table = 'vista_personas_usuarios_roles'; 

    // El campo clave primario de la vista (aunque las vistas son de solo lectura, es necesario)
    protected $primaryKey = 'persona_id';
    
    // Protegemos contra asignación masiva, aunque no se usará para guardar
    protected $guarded = [];
}