<?php

use App\Http\Controllers\CarritoController;
use App\Models\Insumo;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\pedidoController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\CategoriumController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InsumoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\contrasenaController;
use App\Models\Categorium;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Vista cliente
Route::get('/', function () {
    $categorias = Categorium::where('activo', true)->get(); // Obtén todas las categorías activas
    $productos = Producto::all(); // Obtén todos los productos
    $Insumo = Insumo::all();

    return view('welcome', compact('categorias', 'productos','Insumo'));
})->name('Bienvenido');

// Vista cliente
Route::get('/Producto', function () {
    $productos = Producto::all();
    $categorias = Categorium::where('activo', true)->get(); // Obtén todas las categorías activas
    $Insumo = Insumo::all();

    return view('cliente.productos', compact('productos', 'categorias','Insumo'));
})->name('Productos');

//cambiar contraseña administrador
Route::get('/NewPassword2', [contrasenaController::class, 'NewPassword2'])->name('NewPassword2')->middleware('auth');
Route::post('/change/password2', [contrasenaController::class, 'changePassword2'])->name('changePassword2');
//editar perfil de administrador
Route::get('/NewPassword', [UserSettingsController::class, 'NewPassword'])->name('NewPassword')->middleware('auth');
Route::post('/change/password', [UserSettingsController::class, 'changePassword'])->name('changePassword');


//editar perfil de cliente
Route::get('/newperfil', [UserSettingsController::class, 'newperfil'])->name('newperfil')->middleware('auth');
Route::post('/change/changeperfil', [UserSettingsController::class, 'changeperfil'])->name('changeperfil');


//cambiar contraseña perfil
Route::get('/newcontrasena', [contrasenaController::class, 'newcontrasena'])->name('newcontrasena')->middleware('auth');
Route::post('/change/changecontrasena', [contrasenaController::class, 'changecontrasena'])->name('changecontrasena');


Route::put('/roles/{role}/activate', [RolController::class, 'activate'])->name('roles.activate');
Route::put('/roles/{role}/deactivate', [RolController::class, 'deactivate'])->name('roles.deactivate');





Route::get('/admin/dashboard', [UsuarioController::class, 'adminDashboard'])->name('admin.dashboard');




Route::middleware(['role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [UsuarioController::class, 'clienteDashboard'])->name('cliente.dashboard');
});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// modulos de Johan

Route::get('/carrito', [CarritoController::class, 'carrito'])->name('carrito');
// modulos de Johan


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/roles/{id}/show', 'RolController@show')->name('roles.show');
    Route::resource('roles', RolController::class);

    Route::get('/usuarios/{id}/show', 'UsuarioController@show')->name('usuarios.show');
    Route::resource('usuarios', UsuarioController::class);
    Route::put('roles/{id}/status', [RolController::class, 'updateStatus'])->name('roles.updateStatus');

    Route::put('/user/password', [UsuarioController::class, 'updatePassword'])->name('usuarios.updatePassword');

    //clientes

    Route::get('/A_clientes', [UsuarioController::class, 'indexc'])->name('A_clientes.index');
    Route::get('/A_clientes/create', [UsuarioController::class, 'createc'])->name('A_clientes.create');
    Route::post('/A_clientes', [UsuarioController::class, 'storec'])->name('A_clientes.store');
    Route::get('/A_clientes/{id}/show', [UsuarioController::class, 'showc'])->name('A_clientes.show');
    Route::get('/A_clientes/{id}/edit', [UsuarioController::class, 'editc'])->name('A_clientes.edit');
    Route::match(['put', 'patch'], '/A_clientes/{id}', [UsuarioController::class, 'updatec'])->name('A_clientes.update');
    Route::delete('/A_clientes/{id}', [UsuarioController::class, 'destroyc'])->name('A_clientes.destroy');

    // modulos de Johan

    Route::put('/pedidos/{id}/updateEstado', [pedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');
    Route::put('/pedidos/{id}/updateEstadoo', [pedidoController::class, 'updateEstadoo'])->name('pedidos.updateEstadoo');
    Route::resource('pedidos', pedidoController::class);
    Route::get('/admin/grafica', [ventasController::class, 'graficatop10'])->name('admin.grafica');
    // Route::get('/admin/dashboard', [ventasController::class, 'informe'])->name('admin.dashboard');
    Route::resource('ventas', ventasController::class);
    Route::get('pdf/{id}', [pedidoController::class, 'showPdf'])->name('pdf');
   // Rutas para guardar el pedido
   Route::post('/guardar-pedido', [PedidoController::class, 'guardarPedido'])->name('guardarPedido');





    // routes/web.php


    Route::get('/pedidoss', [pedidoController::class, 'verpedido'])->name('verpedido');
    Route::get('/cliente/pedidos/{id}', [CarritoController::class, 'show'])->name('Detalle');
    


    // Route::get('/carrito', 'App\Http\Controllers\PedidoController@carrito')->name('carrito');
    // Route::get('/carrito', [App\Http\Controllers\PedidoController::class, 'carrito'])->name('carrito');
    // Route::get('/carrito', [PedidoController::class, 'carrito'])->name('carrito');



    // Route::post('/carrito', [PedidoController::class, 'carrito'])->name('carrito');
    // modulos de Johan

    // diego

    Route::resource('Categorias', CategoriumController::class)->names('categoria');
    Route::resource('Productos', ProductoController::class)->names('productos');
    Route::resource('Insumos', InsumoController::class)->names('insumo');
});