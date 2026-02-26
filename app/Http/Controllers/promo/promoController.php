<?php

namespace App\Http\Controllers\promo;

use App\Http\Controllers\Controller;
use App\Http\Requests\promo\categoriaRequest;
use App\Http\Requests\promo\daPromoRequest;
use App\Http\Requests\promo\promoRequest;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\MarcaProyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class promoController extends Controller
{
    // FUNCION PARA CARGAR LA PROMOCIÓN POR PROYECTO
    public function promo_marca(promoRequest $request, int $id) {
        $resp=['res' => false, 'msg' => 'No se encuentra la marca'];
        $status_resp = 404;
        $user_token = $request->user();
        try {
            $marca = Marca::where('id_marcas', $id)->firstOrFail();
        } catch (\Throwable $th) {
             $status_resp = 400;
            return response()->json($resp, $status_resp);
        }
        if( $user_token->idusuario != $marca->id_usuario_marca ) {
            $status_resp = 401;
            return response()->json($resp, $status_resp);
        }
        $promo = MarcaProyecto::updateOrCreate(
            ['id_marca' => $marca->id_marcas,
            'id_proyecto' => $request->proyecto],
            [
            'id_marca' => $marca->id_marcas,
            'id_proyecto' => $request->proyecto,
            'f_inicio' => $request->f_inicio,
            'vigencia' => $request->vigencia,
            'desc_promo' => $request->desc_promo,
            'promo' => $request->promo,
            'restric'=> $request->restric,
            'fecha_registro' => Carbon::now()
        ]);
        return response()->json(['res' => true, 'msg' => 'Promoción registrada correctamente'], 200);
    }
    // FUNCION PARA OBTENER LAS PROMOCIONES DE UNA MARCA
    public function trae_promo(daPromoRequest $request) {
        $resp=['res' => false, 'msg' => 'No se encuentra la marca'];
        $status_resp = 404;
        $user_token = $request->user();
        try {
            $marca = Marca::where('id_marcas', $request->marca)->firstOrFail();
        } catch (\Throwable $th) {
             $status_resp = 400;
            return response()->json($resp, $status_resp);
        }
        if( $user_token->idusuario != $marca->id_usuario_marca ) {
            $status_resp = 401;
            return response()->json($resp, $status_resp);
        }
        $promo = MarcaProyecto::where([['id_marca', $request->marca], ['id_proyecto', $request->proyecto]])->get();
        return response()->json(['res' => true, 'data' => $promo], 200);
    }
    // FUNCION CREA UNA NUEVA CATEGORIA
    public function crea_categoria(categoriaRequest $request) {
        $resp=['res' => true, 'msg' => 'Categoria creada'];
        $status_resp = 200;
        $categoria = new Categoria();
        $categoria->nombre = $request->categoria;
        $categoria->activo = 0;
        try {
            $categoria->save();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'Algo salio mal'];
            $status_resp = 500;
        }
        return response()->json($resp, $status_resp);
    }
}
