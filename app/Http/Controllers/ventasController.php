<?php

namespace App\Http\Controllers;

use App\Models\detalle_pedidos;
use App\Models\pedido;
use App\Models\producPerz;
use App\Models\Producto;
use App\Models\productos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ventasController extends Controller
{
    public function admingrafica()
    {
        // Lógica y datos necesarios para el dashboard del administrador

        return view('admin.grafica');
    }

    function __construct()
    {
         
         $this->middleware('permission:ventas', ['only' => ['create','store' , 'destroy' , 'edit','update' , 'index' ]]);
         
    }

    
    public function index()
    {
        $ventas = Pedido::with('users')->get();
        return view('ventas.index', compact('ventas'));

    }
    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        //
    }
   
    // public function graficatop10()
    // {
    //     $ventas = Pedido::with('users')->where('Estado', 'Finalizado')->get();
    //     return view('ventas.graficatop10', compact('ventas'));
    // }

    // public function graficatop10()
    // {
    //     // $topProductos = Producto::select('id', 'nombre')
    //     // ->withCount('detallesPedidos')
    //     // ->orderByDesc('detalles_pedidos_count')
    //     // ->take(10)
    //     // ->get();

    //     $topProductos = Producto::select('productos.nombre', \DB::raw('COUNT(detalle_pedidos.id_productos) as count'))
    //     ->join('detalle_pedidos', 'productos.id', '=', 'detalle_pedidos.id_productos')
    //     ->join('pedidos', 'detalle_pedidos.id_pedidos', '=', 'pedidos.id')
    //     ->where('pedidos.Estado', 'Finalizado')
    //     ->groupBy('productos.nombre')
    //     ->orderBy('count', 'desc')
    //     ->take(3)
    //     ->get();

    //     // return response()->json($topProductos);

        

    // return view('ventas.graficatop10', compact('topProductos'));
    // }

    public function graficatop10()
    {
        $topProductos = Producto::select('productos.nombre', \DB::raw('SUM(detalle_pedidos.cantidad) as total_vendido'))
        ->join('detalle_pedidos', 'productos.id', '=', 'detalle_pedidos.id_productos')
        ->join('pedidos', 'detalle_pedidos.id_pedidos', '=', 'pedidos.id')
        ->where('pedidos.Estado', 'Finalizado')
        ->groupBy('productos.nombre')
        ->orderByDesc('total_vendido')
        ->take(3)
        ->get();


        $cantidadPorMes = detalle_pedidos::select(
            \DB::raw('YEAR(created_at) as year'),
            \DB::raw('MONTH(created_at) as month'),
            \DB::raw('SUM(cantidad) as total_cantidad')
        )
        ->whereHas('pedido', function ($query) {
            $query->where('Estado', 'Finalizado');
        })
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
    
        return view('admin.grafica', compact('topProductos', 'cantidadPorMes'));
    }
    

   




    public function show($id)
    {
         // Recuperar el pedido y sus detalles de la base de datos
         $pedido = Pedido::with('users')->find($id);

         $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();
         $personaliza = producPerz::where('id_pedidos', $id)->get();

         // Pasar el pedido y sus detalles a la vista
         return view('ventas.show', ['pedido' => $pedido, 'detalles_pedidos' => $detalles_pedidos, 'personaliza' => $personaliza]);
        // return view('ventas.graficatop10', compact('topProductos'))->with('count', 1);


         // return view('ventas.show'); 
    }
    


     

    public function edit($id)
    {
        // 
    }

    public function update(Request $request)
    {
        // 
    }
  



}