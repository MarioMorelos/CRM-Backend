<?php

namespace App\Http\Controllers\reporte;

use App\Http\Controllers\Controller;
use App\Http\Requests\reporte\descargaRequest;
use App\Http\Requests\reporte\marcaRequest;
use App\Models\Categoria;
use App\Models\CatStatus;
use App\Models\Descarga;
use App\Models\Marca;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Zona;
use Carbon\Carbon;
use Illuminate\Http\Request;

class reporteController extends Controller
{
    // FUNCION PARA REPORTE GENERAL DE MARCAS
    public function reporte_marcas(marcaRequest $request) {
            $marcas = Marca::with(['marcaProyecto.proyecto', 'categoria', 'id_estatus'])
            ->when($request->marca, function ($query) use ($request) {
                $query->whereIn('id_marcas', $request->marca);
            })
            ->when($request->proyecto, function ($query) use ($request) {
                $query->whereIn('id_proyecto', $request->proyecto);
            })
            ->when($request->estatus, function ($query) use ($request) {
                $query->whereIn('id_cat_estatus', $request->estatus);
            })
            ->when($request->categoria, function ($query) use ($request) {
                $query->whereIn('id_categoria', $request->categoria);
            })
            ->when($request->ejecutivo, function ($query) use ($request) {
                $query->whereIn('id_usuario_marca', $request->ejecutivo);
            })
            ->get();
            $arr_reporte = [];
            $arr_proyectos = [];
            foreach ($marcas as $marca) {
                $arr_categorias = [];
                foreach ($marca->categoria as $categoria) {
                    array_push($arr_categorias, [
                        "nombre" => $categoria->nombre
                    ]);
                }
                foreach ($marca->marcaProyecto as $proyecto) {
                    array_push($arr_proyectos, [
                        "nombre" => $proyecto->proyecto->nombre_proyecto
                    ]);
                }
                array_push($arr_reporte, [
                    "id" => $marca->id_marcas,
                    "nombre" => $marca->nombre,
                    "proyecto" => $arr_proyectos,
                    "categoria" => $arr_categorias,
                    "estatus" => $marca->id_estatus ? $marca->id_estatus->nombre : null,
                    "ejecutivo" => $marca->user ? $marca->user->nombre." ".$marca->user->apellidos : null
                ]);
            }
            return response()->json([
                "resp" => true,
                "data" => [
                    "marcas"=>$arr_reporte
                ]], 200);
    }
    // FUNCION PARA MOSTRAR LOS FILTROS NECESARIOS PARA LOS REPORTES
    public function filtros(Request $request) {
        $arr_marcas = [];
        $arr_proyectos = [];
        $arr_status = [];
        $arr_categorias = [];
        $arr_ejecutivos = [];
        $marcas = Marca::all();
        foreach($marcas as $marca) {
            array_push($arr_marcas, [ "id" => $marca->id_marcas ,"nombre"=>$marca->nombre]);
        }
        $proyectos = Proyecto::all();
        foreach($proyectos as $proyecto) {
            array_push($arr_proyectos, [ "id" => $proyecto->id_proyecto ,"nombre"=>$proyecto->nombre_proyecto]);
        }
        $estatus = CatStatus::all();
        foreach($estatus as $status) {
            array_push($arr_status, [ "id" => $status->id_estatus ,"nombre"=>$status->nombre]);
        }
        $categorias = Categoria::all();
        foreach($categorias as $categoria) {
            array_push($arr_categorias, [ "id" => $categoria->id_categoria ,"nombre"=>$categoria->nombre]);
        }
        $ejecutivos = User::where('id_grupo', '!=', 0)->get();
        foreach($ejecutivos as $ejecutivo) {
            array_push($arr_ejecutivos, [ "id" => $ejecutivo->idusuario ,"nombre"=>$ejecutivo->nombre." ".$ejecutivo->apellidos]);
        }
        return response()->json([
            "resp" => true,
            "data" => [
                "marcas"=>$arr_marcas,
                "proyectos"=>$arr_proyectos,
                "estatus"=>$arr_status,
                "categorias"=>$arr_categorias,
                "ejecutivos"=>$arr_ejecutivos
            ]], 200);
    }
    // FUNCION PARA REPORTE DE DESCARGAS
    public function descargas(descargaRequest $request) {
        // LOGICA PARA REPORTE DE DESCARGAS
        $descargas = Descarga::with('marca.categoria')
        ->when($request->marca, function ($query) use ($request) {
                $query->whereIn('id_marca', $request->marca);
            })
        ->when($request->categoria, function ($query) use ($request) {
                $query->whereHas('marca.categoria', function ($query) use ($request) {
                    $query->whereIn('tbl_categorias.id_categoria', $request->categoria);
                });
            })
        ->when($request->f_inicio, function ($query) use ($request) {
                $query->where('fecha_descarga', '>=', $request->f_inicio);
            })
        ->when($request->f_fin, function ($query) use ($request) {
                $query->where('fecha_descarga', '<=', $request->f_fin);
            })
        ->get();
        $arr_descargas = [];
        foreach($descargas as $descarga) {
            array_push($arr_descargas, [
                "marca" => $descarga->marca ? $descarga->marca->nombre : null,
                "fecha_descarga" => Carbon::parse($descarga->fecha_descarga)->format('Y-m-d H:i:s')
            ]);
        }
        return response()->json([
            "resp" => true,
            "descargas"=>$arr_descargas
            ], 200);
    }
    // FUNCION PARA MOSTRAR LOS FILTROS NECESARIOS PARA LOS REPORTES DE DESCARGAS
    public function filtros_descargas(Request $request) {
        $arr_marcas = [];
        $arr_categorias = [];
        $marcas = Marca::all();
        foreach($marcas as $marca) {
            array_push($arr_marcas, [ "id" => $marca->id_marcas ,"nombre"=>$marca->nombre]);
        }
        $categorias = Categoria::all();
        foreach($categorias as $categoria) {
            array_push($arr_categorias, [ "id" => $categoria->id_categoria ,"nombre"=>$categoria->nombre]);
        }
        return response()->json([
            "resp" => true,
            "data" => [
                "marcas"=>$arr_marcas,
                "categorias"=>$arr_categorias
            ]], 200);
    }
    // FUNCION PARA OBTENER METRICAS
    public function metricas(Request $request) {
        $total_marcas = Marca::count();
        $total_descargas = Descarga::count();
        $total_marcas_publicadas = Marca::where('id_cat_estatus', 4)->count();
        $estatus = CatStatus::all();
        $marcas_estatus = [];
        foreach($estatus as $status) {
            $count_estatus = Marca::where('id_cat_estatus', $status->id_estatus)->count();
            array_push($marcas_estatus, [
                "estatus" => $status->nombre,
                "total_marcas" => $count_estatus
            ]);
        }
        $categorias = Categoria::all();
        $marcas_categoria = [];
        foreach($categorias as $categoria) {
            $count_categoria = Marca::whereHas('categoria', function ($query) use ($categoria) {
                $query->where('tbl_categorias.id_categoria', $categoria->id_categoria);
            })->count();
            array_push($marcas_categoria, [
                "categoria" => $categoria->nombre,
                "total_marcas" => $count_categoria
            ]);
        }
        $usuarios = User::where([['id_grupo', '!=', 0], ['activo', '=', 0]])->get();
        $marcas_usuario = [];
        foreach ($usuarios as $key => $usuario) {
            $count_usuario = Marca::where('id_usuario_marca', $usuario->idusuario)->count();
            array_push($marcas_usuario, [
                "usuario" => $usuario->nombre." ".$usuario->apellidos,
                "total_marcas" => $count_usuario
            ]);
        }
        $marcas_mes = Marca::selectRaw("YEAR(fecha_registro) as anio,
        MONTH(fecha_registro) as mes_num,
        DATE_FORMAT(fecha_registro, '%M') as mes_nombre,
        COUNT(*) as total")
        ->whereBetween('fecha_registro', [Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth()])
        ->groupBy('anio', 'mes_num', 'mes_nombre')
        ->orderBy('anio')
        ->orderBy('mes_num')
        ->get();
        return response()->json([
            "resp" => true,
            "data" => 
            [
                "total_marcas"=>$total_marcas,
                "total_descargas"=>$total_descargas,
                "total_marcas_publicadas"=>$total_marcas_publicadas,
                "marcas_categoria"=>$marcas_categoria,
                "marcas_estatus"=>$marcas_estatus,
                "marcas_usuario"=>$marcas_usuario,
                "marcas_mes"=>$marcas_mes
            ]], 200);
    }
}