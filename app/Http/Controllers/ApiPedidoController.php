<?php

namespace App\Http\Controllers;

use App\Models\detalle_pedidos;
use App\Models\Insumo;
use App\Models\pedido;
use App\Models\producPerz;
use Illuminate\Http\Request;

class ApiPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = pedido::with('users')->get();

        return response()->json($pedidos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Recuperar el pedido y sus detalles de la base de datos
        $pedido = Pedido::with('users')->find($id);
        $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();
        $personaliza = producPerz::where('id_pedidos', $id)->get();
        $Insumo = Insumo::all();

        // Crear un array asociativo con los datos que deseas devolver
        $data = [
            'pedido' => $pedido,
            'detalles_pedidos' => $detalles_pedidos,
            'personalizados' => $personaliza,
            'Insumo' => $Insumo,
        ];

        // Devolver los datos en una respuesta JSON
        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updateEstadoo(Request $request, $id)
    {
        $request->validate([
            'Estadoo' => 'required|max:200',
        ]);

        $pedido = Pedido::find($id);
        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        $pedido->Estado = $request->input('Estadoo');
        $pedido->save();

        return response()->json(['message' => 'Estado actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}