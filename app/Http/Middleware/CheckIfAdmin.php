<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica que exista un usuario en el request, y que sea administrador
        if ($request->user() !== null && $request->user()->isAdmin()){
            // Permite el acceso al request
            return $next($request);
        }

        // Retorna un error de redireccion
        abort(403);
        // return->redirect();
    }
}
