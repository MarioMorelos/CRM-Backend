<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_grupo')->insert([
            ['id_grupo' => 1, 'nobre_grupo' => 'Redes', 'activo' => 0],
            ['id_grupo' => 2, 'nobre_grupo' => 'Bancos', 'activo' => 0],
            ['id_grupo' => 3, 'nobre_grupo' => 'Cashback', 'activo' => 0],
        ]);
    }
}
