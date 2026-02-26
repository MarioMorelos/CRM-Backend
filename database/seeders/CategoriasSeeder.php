<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_categorias')->insert([
            ['id_categoria' => 1, 'nombre' => 'Automotriz', 'activo' => 0],
            ['id_categoria' => 2, 'nombre' => 'Comercio / Servicios', 'activo' => 0],
            ['id_categoria' => 3, 'nombre' => 'Educación / Idiomas', 'activo' => 0],
            ['id_categoria' => 4, 'nombre' => 'Entretenimiento', 'activo' => 0],
            ['id_categoria' => 5, 'nombre' => 'Escuela', 'activo' => 0],
            ['id_categoria' => 6, 'nombre' => 'Hotelería / Turismo', 'activo' => 0],
            ['id_categoria' => 7, 'nombre' => 'OnLine', 'activo' => 0],
            ['id_categoria' => 8, 'nombre' => 'Restaurante / Comida Rápida', 'activo' => 0],
            ['id_categoria' => 9, 'nombre' => 'Salud / Belleza', 'activo' => 0],
            ['id_categoria' => 11, 'nombre' => 'Electronics', 'activo' => 0],
        ]);
    }
}
