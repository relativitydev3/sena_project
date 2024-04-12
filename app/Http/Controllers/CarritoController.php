<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\detalle_pedidos;
use App\Models\pedido;
use App\Models\producPerz;

class CarritoController extends Controller
{

    public function carrito()
    {
        return view('cliente.carrito');
    }

    public function store()
    {
        // Obtener el usuario autenticado
    }
    
    public function show($id)
    {
        // Recuperar el pedido y sus detalles de la base de datos
        $pedido = Pedido::with('users')->find($id); // Cambiar 'users' por 'user'
        $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();
        $personaliza = producPerz::where('id_pedidos', $id)->get();
        // Pasar el pedido y sus detalles a la vista
        return view('cliente.Detalles', compact('pedido', 'detalles_pedidos', 'personaliza'));
    }
}
