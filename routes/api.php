<?php

use App\Http\Controllers\marca\MarcaController;
use App\Http\Controllers\promo\promoController;

use App\Http\Controllers\reporte\reporteController;
use App\Http\Controllers\sucursal\sucursalController;
use App\Http\Controllers\user\loginController;
use App\Http\Controllers\user\passwordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/register', [loginController::class, 'register']);
    Route::put('/edit_user/{id}', [loginController::class, 'edit_user'])->whereNumber('id');;
    Route::get('/marcas', [MarcaController::class, 'marcas']);
    Route::patch('/marcas/active/{id}', [MarcaController::class, 'act_marca'])->whereNumber('id');
    Route::get('/marcas/{id}', [MarcaController::class, 'detalle_marca'])->whereNumber('id');
    Route::post('/marcas', [MarcaController::class, 'crear_marca']);
    Route::put('/marcas/{id}', [MarcaController::class, 'editar_marca'])->whereNumber('id');
    // Route::patch('/marcas/{id}', [MarcaController::class, 'solicitud_marca'])->whereNumber('id');
    Route::post('/promo/{id}', [promoController::class, 'promo_marca'])->whereNumber('id');
    Route::get('/promo', [promoController::class, 'trae_promo']);
    Route::post('/categoria', [promoController::class, 'crea_categoria']);
    Route::get('/sucursales/{id}', [sucursalController::class, 'sucursales_marca'])->whereNumber('id');
    Route::post('/sucursal', [sucursalController::class, 'crear_sucursal']);
    Route::put('/sucursal', [sucursalController::class, 'editar_sucursal']);
    Route::get('/sucursal/{id}', [sucursalController::class, 'mostrar_sucursal'])->whereNumber('id');
    Route::delete('/sucursal/{id}', [sucursalController::class, 'eliminar_sucursal'])->whereNumber('id');
    Route::get('/reporte/filtros', [reporteController::class, 'filtros']);
    Route::get('/reporte/marcas', [reporteController::class, 'reporte_marcas']);
    Route::get('/reporte/descargas', [reporteController::class, 'descargas']);
    Route::get('/reporte/filtros_descargas', [reporteController::class, 'filtros_descargas']);
    Route::get('/reporte/metricas', [reporteController::class, 'metricas']);
});

Route::post('/login', [loginController::class, 'login']);
Route::post('/olvide_password', [passwordController::class, 'olvide_password']);
Route::post('/nueva_password', [passwordController::class, 'nueva_password']);

