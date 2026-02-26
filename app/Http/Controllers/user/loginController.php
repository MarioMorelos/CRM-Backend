<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\login\editUserRequest;

use App\Http\Requests\login\loginRequest;
use App\Http\Requests\login\registerRequest;
use App\Models\Modulo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    /** 
     * FUNCION PARA GUARDAR DEL USUARIO 
     * 
     * @param  App\Http\Requests\login\registerRequest  $request
     * 
     * @bodyParam string email required The email of the user. Example: john.doe@mail.com
     * @bodyParam integer id_grupo required Number indicates group that belong. Example: 1
     * @bodyParam string nombre required First name of the user. Example: John
     * @bodyParam string apellidos required The last name of the user. Example: Doe
     * @bodyParam integer id_rol required Number indicates permission that have. Example: 1
     * 
     * @response 201 {
     *   "res": true,
     *   "msg": "Se genero el usuario con Exito"
     * }
     * 
     * @response 400 {
     *   "res": false,
     *   "msg": "No es posible generar el usuario"
     * }
     * 
     * @response 409 {
     *   "res": false,
     *   "msg": "Error al generar el usuario"
     * }
     * 
    */
    public function register(registerRequest $request)
    {
        $resp=['res' => false, 'msg' => 'No es posible generar el usuario'];
        $status_resp = 400;
        $user_token = $request->user();
        if( $user_token->id_rol != 4 ){
            return response()->json($resp, $status_resp);
        }
        $user = new User;
        $user->id_grupo = $request->id_grupo;
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->id_rol = $request->id_rol;
        $user->activo = 0;
        $user->pass_default = 1;
        $resp['msg'] = "Se genero el usuario con Exito";
        $status_resp = 201;
        try {
            $user->save();
        } catch (\Throwable $th) {
            $resp['msg'] = "Error al generar el usuario";
            $status_resp = 409;
            // $resp['error'] = $th->getMessage();
        }
        return response()->json($resp, $status_resp);
    }

    // FUNCION PARA VALIDAR DEL USUARIO
    public function login(loginRequest $request)
    {
        $resp=['res' => false, 'msg' => 'Algo Salio mal'];
        $status_resp=400;
        $user = User::where([['activo', '=', 0],['email', $request->email]])->first();
        // BUSCA SI EL USUARIO EXISTE
        if ( $user ) {
            // SI EL USUARIO TIENE LA CONTRASEÑA POR DEFECTO DEBE CAMBIARLA
            if ($user->pass_default == 1) {
                if( Hash::check($request->password, $user->password) ) {
                    $token = genera_token();
                    $resp = [
                        "res" => true,
                        "msg" => "Cambiar contraseña",
                        "cod_unico" => $token
                    ];
                    $status_resp=200;
                    $user->token = $token;
                    $user->save();
                } else {
                    $resp['msg'] = "Datos no validos.";
                    $status_resp=401;
                }
            } else {
                // EL USUARIO SE LOGUEA DIRECTAMENTE SI NO ES CONTRASEÑA POR DEFECTO
                $tiempo_expira=5;
                $date = Carbon::now();
                // if ( Hash::check($request->password, $user->password) ) {
                if( md5($request->password) == $user->password) {
                    $user->fecha_ultimo_acceso = $date;
                    $user->save();
                    $screen_no_module = [];
                    // LEE TODAS LAS PANTALLAS A LAS QUE TIENE ACCESO EL USUARIO
                    foreach ($user->pantalla as $pantalla) {
                        array_push($screen_no_module, array("nombre" => $pantalla->nombre, "ruta" => $pantalla->ruta, "id_modulo" => $pantalla->idmodulo));
                    }
                    $arr = array();
                    // ORDENA LAS PANTALLAS PARA PROCESARLAS
                    foreach ($screen_no_module as $key => $item ) {
                        $arr[$item['id_modulo']][$key] = $item;
                    }
                    ksort($arr, SORT_NUMERIC);
                    $screen = array();
                    // AGRUPA LAS PANTALLAS POR MODULO Y COLOCA LOS DATOS DE EL MODULO
                    foreach ($arr as $key => $item ) {
                        $i = 0;
                        $modulo = Modulo::where('id_modulo',$key)->firstOrFail();
                        foreach($item as $llave => $articulo){
                            $screen[$modulo->nombre]["screen"][$i] = $articulo;
                            $i++;
                        }
                        $screen[$modulo->nombre]["orden"] = $modulo->orden;
                        $screen[$modulo->nombre]["icono"] = $modulo->icono;
                        $screen[$modulo->nombre]["pagina"] = $modulo->pagina;
                        $screen[$modulo->nombre]["activo"] = $modulo->activo;
                    }
                    $token = $user->createToken("Palabra_Secreta");
                    $resp = [
                        "res" => true,
                        "token" => $token->plainTextToken,
                        "created_at"=>$date->format('Y-m-d H:i:s'),
                        "expired_at"=>$date->addMinutes($tiempo_expira)->format('Y-m-d H:i:s'),
                        'rol' => $user->rol->rol,
                        'pantallas' => $screen
                    ];
                    $status_resp=200;
                } else {
                    $resp['msg'] = "Usuario no valido.";
                    $status_resp=401;
                }
            }  
        } else {
            $resp['msg'] = "Usuario no valido.";
            $status_resp=404;
        }
        return response()->json($resp, $status_resp);
    }
    // FUNCION PARA EDITAR INFORMACIÓN DEL USUARIO
    public function edit_user(editUserRequest $request, int $id)
    {
        $resp=['res' => false, 'msg' => 'No es posible editar el usuario'];
        $status_resp = 400;
        $user_token = $request->user();
        try {
            $user = User::findOrFail($id);
        } catch (\Throwable $th) {
            $resp=['res' => false, 'msg' => 'Usuario no encontrado'];
            $status_resp = 404;
            return response()->json($resp, $status_resp);
        }
        if( $user_token->idusuario != $id ){
            return response()->json($resp, $status_resp);
        }
        // SE MODIFICA LA INFORMACIÓN DEL USUARIO
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->password = Hash::make($request->password);
        try {
            $user->save();
            $resp['msg'] = "Se edito el usuario con Exito";
            $resp['res'] = true;
            $status_resp = 200;
        } catch (\Throwable $th) {
            $resp['msg'] = "Error al editar el usuario";
            $status_resp = 409;
        }
        return response()->json($resp, $status_resp);
    }
}
