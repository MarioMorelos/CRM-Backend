<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_modulo')->insert([
            ['id_modulo' => 1, 'nombre' => 'USUARIOS', 'icono' => 'group', 'pagina' => 'usuario/usuarios', 'orden' => 1, 'activo' => 0],
            ['id_modulo' => 2, 'nombre' => 'MARCAS', 'icono' => 'view_module', 'pagina' => 'marcas/marcass', 'orden' => 2, 'activo' => 0],
            ['id_modulo' => 3, 'nombre' => 'REPORTES', 'icono' => 'trending_up', 'pagina' => null, 'orden' => 5, 'activo' => 0],
        ]);
    }
}
