<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropiedadesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('propiedades')->insert([
            [
                'id' => 1,
                'id_usuario' => 1,
                'id_tipo_propiedad' => 1,
                'titulo' => 'Depto moderno en zona centro',
                'descripcion' => 'Departamento de 2 ambientes, ideal para 2 estudiantes.',
                'fecha_publicacion' => '2025-09-20',
                'created_at' => null,
                'updated_at' => '2025-09-25 19:18:16',
            ],
            [
                'id' => 2,
                'id_usuario' => 2,
                'id_tipo_propiedad' => 2,
                'titulo' => 'Casa familiar con patio',
                'descripcion' => 'Vivienda de 3 habitaciones con jardín y cochera.',
                'fecha_publicacion' => '2025-09-21',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'id_usuario' => 3,
                'id_tipo_propiedad' => 1,
                'titulo' => 'Monoambiente funcional',
                'descripcion' => 'Departamento pequeño, bien ubicado y luminoso.',
                'fecha_publicacion' => '2025-09-22',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'id_usuario' => 1,
                'id_tipo_propiedad' => 2,
                'titulo' => 'mansion',
                'descripcion' => '123123123',
                'fecha_publicacion' => '2025-09-17',
                'created_at' => '2025-09-26 00:43:34',
                'updated_at' => '2025-09-26 00:43:34',
            ],
        ]);
    }
}
