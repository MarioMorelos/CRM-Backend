<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PantallaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_pantalla')->insert([
            ['idpantalla' => 1, 'nombre' => ' Admin Usuarios', 'ruta' => '../usuarios/usuarios.php', 'activo' => 0, 'idmodulo' => 1],
            ['idpantalla' => 2, 'nombre' => 'Admin Marcas ', 'ruta' => '../marcas/admin_marcas.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 3, 'nombre' => 'Solicitar Marca', 'ruta' => '../marcas/solicita_marca.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 4, 'nombre' => 'Seguimiento Marca', 'ruta' => '../marcas/seguimiento_marca.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 5, 'nombre' => 'Aprobación Marca', 'ruta' => '../marcas/aprobacion_marca.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 6, 'nombre' => 'Publicación  Marca', 'ruta' => '../marcas/publicacion_marca.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 7, 'nombre' => 'Reporte General', 'ruta' => '../reportes/reportes.php', 'activo' => 0, 'idmodulo' => 3],
            ['idpantalla' => 15, 'nombre' => 'Admin Campaña', 'ruta' => '../marcas/admin_campania.php', 'activo' => 0, 'idmodulo' => 2],
            ['idpantalla' => 16, 'nombre' => 'Reporte Descargas', 'ruta' => '../reportes/reporte_descargas.php', 'activo' => 0, 'idmodulo' => 3],
            ['idpantalla' => 19, 'nombre' => 'Editar Mi Usuario', 'ruta' => '../usuarios/edit_usuario.php', 'activo' => 0, 'idmodulo' => 1],
        ]);
    }
}
