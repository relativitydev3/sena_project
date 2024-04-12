<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheckMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Redirigir o devolver una respuesta de error en caso de que el usuario no tenga el rol requerido.
        return abort(403, 'Acceso denegado.');
    }
}
