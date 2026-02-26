<?php

namespace App\Http\Controllers\sucursal;

use App\Http\Controllers\Controller;
use App\Http\Requests\sucursal\sucursalRequest;
use App\Models\Marca;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class sucursalController extends Controller
{
    // FUNCION PARA MOSTRAR LAS SUCURSALES DE UNA MARCA
    public function sucursales_marca(Request $request, int $id)
    {
        $resp=['res' => false, 'msg' => 'No existen sucursales de esa marca'];
        $status_resp = 400;
        try {
            $marca = Marca::where('id_marcas', $id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La marca no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user();
        if ( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No tienes permiso para ver las sucursales de esta marca'];
            $status_resp = 403;
            return response()->json($resp, $status_resp);
        }
        $sucursales = $marca->sucursal()->get();
        $suc_mostrar = [];
        foreach ($sucursales as $sucursal) {
            array_push($suc_mostrar, [
                'nombre' => $sucursal->nombre,
                'tel' => $sucursal->tel,
                'calle' => $sucursal->calle,
                'num_ext' => $sucursal->num_ext,
                'num_int' => $sucursal->num_int,
                'referencia' => $sucursal->referencia,
                'latitud' => $sucursal->latitud,
                'longitud' => $sucursal->longitud,
                'cp' => $sucursal->cp,
                'id_cp' => $sucursal->id_cp,
                'activo' => $sucursal->activo,
            ]);
        }
        $resp=['res' => true, 'msg' => 'Sucursales de la marca', 'sucursales' => $suc_mostrar];
        $status_resp = 200;
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA CREAR SUCURSAL
    public function crear_sucursal(sucursalRequest $request) {
        $resp=['res' => false, 'msg' => 'No se pudo crear la sucursal'];
        $status_resp = 400;
        try {
            $marca = Marca::where('id_marcas', $request->id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La marca no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user();
        if ( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No tienes permiso para crear sucursales de esta marca'];
            $status_resp = 403;
            return response()->json($resp, $status_resp);
        }
        try {
            $marca->sucursal()->create([
                'id_marca' => $request->id,
                'nombre' => $request->nombre,
                'tel' => $request->tel,
                'calle' => $request->calle,
                'num_ext' => $request->num_ext,
                'num_int' => $request->num_int,
                'referencia' => $request->referencia,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'cp' => $request->cp,
                'id_zona' => $request->id_zona
            ]);
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'Error al crear la sucursal'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $resp=['res' => true, 'msg' => 'Sucursal creada correctamente'];
        $status_resp = 200;
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA EDITAR SUCURSAL
    public function editar_sucursal(sucursalRequest $request) {   
        $resp=['res' => false, 'msg' => 'No se pudo editar la sucursal'];
        $status_resp = 400;
        try {
            $sucursal = Sucursal::where('id_sucursal', $request->id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La sucursal no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user(); 
        $marca= Marca::where('id_marcas', $sucursal->id_marca)->first();
        if ( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No tienes permiso para editar esta sucursal'];
            $status_resp = 403;
            return response()->json($resp, $status_resp);
        }
        try {
            $sucursal->update([
                'nombre' => $request->nombre,
                'tel' => $request->tel,
                'calle' => $request->calle,
                'num_ext' => $request->num_ext,
                'num_int' => $request->num_int,
                'referencia' => $request->referencia,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'cp' => $request->cp,
                'id_zona' => $request->id_zona
            ]);
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'Error al editar la sucursal'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $resp=['res' => true, 'msg' => 'Sucursal editada correctamente'];
        return response()->json($resp, 200);
    }
    // FUNCION PARA MOSTRAR SUCURSAL
    public function mostrar_sucursal(Request $request, int $id) {
        $resp=['res' => false, 'msg' => 'No se pudo encontrar la sucursal'];
        $status_resp = 400;
        try {
            $sucursal = Sucursal::where('id_sucursal', $id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La sucursal no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user(); 
        $marca= Marca::where('id_marcas', $sucursal->id_marca)->first();
        if ( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No tienes permiso para ver esta sucursal'];
            $status_resp = 403;
            return response()->json($resp, $status_resp);
        }
        $resp=['res' => true, 'msg' => 'Sucursal encontrada', 'sucursal' => [
            'nombre' => $sucursal->nombre,
            'tel' => $sucursal->tel,
            'calle' => $sucursal->calle,
            'num_ext' => $sucursal->num_ext,
            'num_int' => $sucursal->num_int,
            'referencia' => $sucursal->referencia,
            'latitud' => $sucursal->latitud,
            'longitud' => $sucursal->longitud,
            'cp' => $sucursal->cp,
            'id_cp' => $sucursal->id_cp,
            'activo' => $sucursal->activo,
        ]];
        return response()->json($resp, 200);
    }
    // FUNCION PARA ELIMINAR SUCURSAL
    public function eliminar_sucursal(Request $request, int $id) {
        $resp=['res' => false, 'msg' => 'No se pudo encontrar la sucursal'];
        $status_resp = 400;
        try {
            $sucursal = Sucursal::where('id_sucursal', $id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La sucursal no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user(); 
        $marca= Marca::where('id_marcas', $sucursal->id_marca)->first();
        if ( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No tienes permiso para ver esta sucursal'];
            $status_resp = 403;
            return response()->json($resp, $status_resp);
        }
        $resp=['res' => true, 'msg' => 'Sucursal eliminada correctamente'];
        $status_resp = 200;
        try {
            $sucursal->delete();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'Error al eliminar la sucursal'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        return response()->json($resp, $status_resp);
    }
}