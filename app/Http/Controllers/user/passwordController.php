<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OlvideMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\password\olvideRequest;
use App\Http\Requests\password\newPassRequest;

class passwordController extends Controller
{
    // FUNCION PARA ENVIAR MAIL DE USUARIO
    public function olvide_password(olvideRequest $request)
    {
        $resp=['res' => false, 'msg' => 'Algo Salio mal'];
        $status_resp=400;
        try {
            $user = User::where([['email', '=', $request->email],['activo', '=', 0]])->firstOrFail();
        } catch (\Throwable $th) {
            $resp['msg']='The User do not exist';
            $status_resp=404;
            return response()->json($resp, $status_resp);
        }
        $token = genera_token();
        $data_mail = [
            'name' => $user->nombre." ".$user->apellidos,
            'email' => $user->email,
            'token' => $token,
        ];
        $user->token = $token;
        $user->save();
        $resp['res'] = true;
        $resp['msg'] = 'The mail was sent';
        $status_resp=200;
        try {
            Mail::to($request->email)->send(new OlvideMail($data_mail));
        } catch (\Throwable $th) {
            $resp['msg'] = "The mail wasn't sent";
            $status_resp=409;
        }
        return response()->json($resp, $status_resp);
    }

    // FUNCION PARA GUARDAR NUEVA CONTRASEÑA
    public function nueva_password(newPassRequest $request)
    {
        $resp=['res' => false, 'msg' => 'Algo Salio mal'];
        $status_resp=400;
        try {
            $user = User::where([['token', '=', $request->token],['activo', '=', 0]])->firstOrFail();
        } catch (\Throwable $th) {
            $resp['msg'] = 'The User do not exist';
            $status_resp = 302;
            return response()->json($resp, $status_resp);
        }
        $user->password = Hash::make($request->password);
        $user->token = '';
        $user->save();
        $resp['res'] = true;
        $resp['msg'] = 'The password was change successfully';
        $status_resp = 202;
        return response()->json($resp, $status_resp);
    }

}
