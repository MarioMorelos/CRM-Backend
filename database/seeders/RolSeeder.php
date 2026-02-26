<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_rol')->insert([
            ['id_rol' => 1, 'rol' => 'Ejecutivo'],
            ['id_rol' => 2, 'rol' => 'Supervisor'],
            ['id_rol' => 3, 'rol' => 'Calidad'],
            ['id_rol' => 4, 'rol' => 'Super Admin'],
            ['id_rol' => 5, 'rol' => 'Premium'],
        ]);
    }
}
