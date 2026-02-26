<?php

namespace App\Http\Controllers\marca;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\CatStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\marca\estatusRequest;
use App\Http\Requests\marca\editMarcaRequest;
use App\Http\Requests\marca\createMarcaRequest;

class MarcaController extends Controller
{
    // FUNCION PARA GUARDAR DEL USUARIO
    public function marcas(Request $request)
    {
        $resp=['res' => false, 'msg' => 'No es visualizar las marcas'];
        $status_resp = 400;
        $user_token = $request->user();
        if( $user_token->id_grupo == 0 ){
            return response()->json($resp, $status_resp);
        }
        $marcas = Marca::with('user')->get();
        $marcas_editable = [];
        foreach ($marcas as $marca ) {
            if( $marca->user->idusuario == $user_token->idusuario ) {
                $editable = true;
            }else {
                $editable = false;
            }
            if( $marca->activo == 0 ) {
                $activo = true;
            }else {
                $activo = false;
            }
            array_push($marcas_editable, [
                'id' => $marca->id_marcas,
                'nombre' => $marca->user->nombre,
                'descripcion' => $marca->nombre,
                'estatus' => $marca->id_estatus->nombre,
                'color' => $marca->id_estatus->colorhex,
                'editable' => $editable,
                'activo' => $activo
            ]);
        }
        return $marcas_editable;
    }
    // FUNCION PARA DESACTIVAR/ACTIVAR MARCA EN ESPECIFICO
    public function act_marca(Request $request, int $id) {
        $resp=['res' => false, 'msg' => 'No se encuentra la marca'];
        $status_resp = 404;
        $user_token = $request->user();
        try {
            $marca = Marca::find($id);
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La marca no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        if( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No se puede editar la marca'];
            $status_resp = 400;
        } else {
            if( $marca->activo == 0 ) {
                $marca->activo=1;
            } else {
                $marca->activo=0;
            }
            $marca->save();
            $resp=['res' => true, 'msg' => 'Se actualizo el estatus de la marca'];
            $status_resp = 200;
        }
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA DAR DETALLE DE LA MARCA EN ESPECIFICO
    public function detalle_marca(Request $request, int $id) {
        $resp=['res' => false, 'msg' => 'No se encuentra la marca.'];
        $status_resp = 404;
        $user_token = $request->user();
        try {
            $marca = Marca::where('id_marcas', $id)->firstOrFail();
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'La marca no fue encontrada'];
            $status_resp = 500;
            return response()->json($resp, $status_resp);
        }
        if( $marca->user->idusuario != $user_token->idusuario ) {
            $resp=['res' => false, 'msg' => 'No se puede ver la marca'];
            $status_resp = 400;
        } else {
            $users = User::where('id_grupo', '!=', 0)->get();
            $users_dropdown = [];
            foreach( $users as $user ) {
                $user->idusuario == $marca->user->idusuario ? $select = true : $select = false;
                array_push($users_dropdown, [
                    'id' => $user->idusuario,
                    'nombre' => $user->nombre,
                    'select' => $select
                ]);
            }
            $estatus = CatStatus::all();
            $status_dropdown = [];
            foreach ($estatus as $status) {
                $status->id_estatus == $marca->id_cat_estatus ? $select_status = true : $select_status = false;
                array_push($status_dropdown, [
                    'id' => $status->id_estatus,
                    'nombre' => $status->nombre,
                    'select' => $select_status
                ]);
            }
            $categorias = Categoria::all();
            $categorias_dropdown = [];
            foreach ($categorias as $categoria) {
                // $select_categoria = $categoria->id_categoria == $marca->categoria->id_categoria ? $select = true : $select = false;
                if ( $marca->categoria->contains(function ($q) use ($categoria) {
                    return $q->id_categoria === $categoria->id_categoria;
                }) ) {
                    $select_categoria = true;
                } else {
                    $select_categoria = false;
                }

                array_push($categorias_dropdown, [
                    'id' => $categoria->id_categoria,
                    'nombre' => $categoria->nombre,
                    'select' => $select_categoria
                ]);
            }
            $resp=[
                'res' => true, 'msg' => [                    
                    'id_marca' => $marca->id_marcas,
                    'nombre' => $marca->nombre,
                    'logo' => $marca->logo,
                    'usuarios' => $users_dropdown,
                    'estatus' => $status_dropdown,
                    'activo' => $marca->activo,
                    'com_rechazo' => $marca->com_rechazo,
                    'rs' => $marca->rs,
                    'rfc' => $marca->rfc,
                    'tel' => $marca->tel,
                    'contacto' => $marca->contacto,
                    'mail_contacto' => $marca->mail_contacto,
                    'url' => $marca->url,
                    'vigencia' => $marca->vigencia,
                    'restric' => $marca->restric,
                    'contrato' => $marca->contrato,
                    'imagen' => $marca->imagen,
                    'categoria' => $categorias_dropdown
                ]
            ];
        }
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA CREAR LA MARCA
    public function crear_marca(createMarcaRequest $request) {
        $resp=['res' => false, 'msg' => 'No se creo la marca.'];
        $status_resp = 404;
        $user_token = $request->user();
        $input = $request->all();
        $input['id_usuario_marca'] = $user_token->idusuario;
        $input['activo'] = 1;
        $input['id_cat_estatus']=3;
        $input['fecha_registro']=Carbon::now();
        $input['nombre']=$request->nombre;
        try {
            $marca = Marca::create($input);
            $resp=['res' => true, 'msg' => 'Se creo la marca.'];
            $status_resp = 200;
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => $th->getMessage()];
            $status_resp = 500;
        }
        return response()->json($resp, $status_resp);
    }
    // FUNCION APRUEBA O RECHAZA MARCA
    public function aprueba_marca(estatusRequest $request, $id) {
        $resp=['res' => false, 'msg' => 'No se encuentra la marca'];
        $status_resp = 404;
        if ( !is_numeric($id) ) {
            return response()->json($resp, $status_resp);
        }
        $user_token = $request->user();
        try {
            $marca = Marca::where('id_marcas', $id)->firstOrFail();
        } catch (\Throwable $th) {
            return response()->json($resp, $status_resp);
        }
        if( $user_token->id_grupo == $marca->user->idusuario || $user_token->id_rol != 2 ) {
            return response()->json($resp, $status_resp);
        }
        $input = $request->all();
        if( $input['accion'] == 1 ) {
            $input['id_cat_estatus'] = 1; // Se aprueba la marca
        } else {
            $input['id_cat_estatus'] = 2; // Se marca como rechazada la marca
            $input['com_rechazo'] = $request->com_rechazo; // comentario porque se rechazo
        }
        try {
            $marca->update($input);
            $resp=['res' => true, 'msg' => 'Se actualizo el estatus de la marca'];
            $status_resp = 200;
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => $th->getMessage()];
            $status_resp = 500;
        }
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA EDITAR LA MARCA UNA VEZ QUE FUE APROBADA
    public function editar_marca(editMarcaRequest $request, int $id) {
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
            return response()->json($resp, $status_resp);
        }
        if( in_array($marca->id_cat_estatus, [2,3,9]) ) {
            $resp=['res' => false, 'msg' => 'No se puede editar la marca'];
            return response()->json($resp, $status_resp);
        }
        // CREAR PDF
        $file_name = $id.'_contrato.pdf';
        $folder = 'pdf/convenios';
        arch_adjunto($request->contrato_base64, $file_name, $folder);
        // CREAR IMAGEN LOGO
        $file_name_logo = $id.'_logo.pdf';
        $folder_logo = 'img/logos';
        arch_adjunto($request->logo_base64, $file_name_logo, $folder_logo);
        // // CREAR IMAGEN MARCA
        $file_name_imagen = $id.'_imagen.jpg';
        $folder_imagen = 'img/marcas';
        arch_adjunto($request->imagen_base64, $file_name_imagen, $folder_imagen);
        // ACTUALIZA LAS CATEGORIAS DE LA MARCA
        $marca->categoria()->sync($request->categoria);
        // ACTUALIZA EL VALOR DE LA MARCA
        $marca->rs = $request->rs;
        $marca->tel = $request->tel;
        $marca->contacto = $request->contacto;
        $marca->mail_contacto = $request->mail_contacto;
        $marca->url = $request->url;
        $marca->llam_cal = $request->llam_cal;
        $marca->vis_cal =  $request->vis_cal;
        $marca->id_cat_estatus = $request->estatus;
        $marca->contrato = $file_name;
        $marca->logo = $file_name_logo;
        $marca->imagen = $file_name_imagen;
        $resp['msg'] = 'Marca actualizada correctamente';
        $status_resp = 200;
        try {
            $marca->save();
        } catch (\Throwable $th) {
            $resp['msg'] = 'No se pudo actualizar la marca';
            $status_resp = 500;
        }
        return response()->json($resp, $status_resp);
    }
}
