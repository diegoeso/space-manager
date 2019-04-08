<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ConfirmarCuenta
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
        if (Auth::user()->confirmacion == 0 && Auth::user()->codigoConfirmacion != null) {
            return redirect()->route('confirmarCuenta');
        }
        return $next($request);

    }
}
