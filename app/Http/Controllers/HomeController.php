<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Insumo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->indexData();
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return redirect('/admin/dashboard');
        } elseif ($user->hasRole('cliente')) {
            return view('welcome', $data);
        } else {
            // Redirige a una página predeterminada si el usuario no tiene un rol específico
            return redirect('/admin/dashboard');
        }
    }
    public function indexData()
    {
        $categorias = Categorium::where('activo', true)->get();
        $productos = Producto::all();
        $Insumo = Insumo::all();
        return compact('categorias', 'productos','Insumo');
    }
}