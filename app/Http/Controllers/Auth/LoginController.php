<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categorium;
use App\Models\Insumo;
use App\Models\Producto;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()->withErrors([
            'login_error' => 'Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {

        $data = $this->indexData();
        // Verificar si el usuario está inactivo
        if (!$user->estado) {
            Auth::logout(); // Desconectar al usuario si está inactivo
            return redirect()->back()->withErrors(['account' => 'Su cuenta está inactiva.']); // Redirigir con un mensaje de error
        }

        if (!$user->roles->first()->estado) {
            Auth::logout(); // Desconectar al usuario si está inactivo
            return redirect()->back()->withErrors(['account' => 'Su cuenta está inactiva.']); // Redirigir con un mensaje de error
        }

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