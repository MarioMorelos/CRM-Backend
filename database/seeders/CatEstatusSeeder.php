<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatEstatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_cat_estatus')->insert([
            ['id_estatus' => 1, 'nombre' => 'aprobada', 'descripcion' => ' se aprobo en sistema', 'color' => 'bg-cyan', 'activo' => 0, 'colorhex' => '#00BCD4'],
            ['id_estatus' => 2, 'nombre' => 'cancelada', 'descripcion' => 'no se aprobo  en el sistema', 'color' => 'bg-red', 'activo' => 0, 'colorhex' => '#F44336'],
            ['id_estatus' => 3, 'nombre' => 'solicitada', 'descripcion' => ' se encuentra pendiente de revision ', 'color' => 'bg-orange', 'activo' => 0, 'colorhex' => '#FF5722'],
            ['id_estatus' => 4, 'nombre' => 'publicada', 'descripcion' => 'esta publicada', 'color' => 'bg-green', 'activo' => 0, 'colorhex' => '#4CAF50'],
            ['id_estatus' => 5, 'nombre' => 'contacto inicial ', 'descripcion' => 'ejecutivo realizo contacto', 'color' => 'bg-purple', 'activo' => 0, 'colorhex' => '#9C27B0'],
            ['id_estatus' => 6, 'nombre' => 'propuesta', 'descripcion' => 'ejecutivo envío propuesta', 'color' => 'bg-deep-purple', 'activo' => 0, 'colorhex' => '#673AB7'],
            ['id_estatus' => 7, 'nombre' => 'interesado', 'descripcion' => 'el cliente le  interesa ', 'color' => 'bg-teal', 'activo' => 0, 'colorhex' => '#009688'],
            ['id_estatus' => 8, 'nombre' => 'afiliada', 'descripcion' => 'se afilio la marca', 'color' => 'bg-pink', 'activo' => 0, 'colorhex' => '#E91E63'],
            ['id_estatus' => 9, 'nombre' => 'no le interesa', 'descripcion' => 'no le interesa a la marca', 'color' => 'bg-black', 'activo' => 0, 'colorhex' => '#000000'],
            ['id_estatus' => 10, 'nombre' => 'vencida', 'descripcion' => 'la vigencia de la marca ya expiro', 'color' => 'bg-grey', 'activo' => 0, 'colorhex' => '#9E9E9E'],
        ]);
    }
}
