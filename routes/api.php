<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPedidoController;
use App\Http\Controllers\InsumoApiController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('nose2', [AuthController::class, 'Register']);
Route::post('nose', [AuthController::class, 'login']);
// Insumos


Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    
   
});



Route::apiResource('insumos', InsumoApiController::class);

Route::post('/crear', [InsumoApiController::class, 'store']);
Route::put('/api/insumos/{id}', 'InsumoController@update');



Route::apiResource('pedidos', ApiPedidoController::class);

Route::put('pedidos/{id}/estado', [ApiPedidoController::class, 'updateEstadoo']);


Route::get('pedidos/{id}', [TuControlador::class, 'show']);



Route::post('/recuperar-contrasena', [ResetPasswordController::class, 'recuperarContrasena']);
Route::post('/verificar-codigo', [ResetPasswordController::class, 'verificarCodigo']);
Route::post('/cambiarContrasena', [ResetPasswordController::class, 'cambiarContrasena']);







