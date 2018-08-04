<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Toastr;

class CompletarRegistro
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
        if (Auth::user()->tipoCuenta == 2 || Auth::user()->tipoCuenta == 3) {
            if (Auth::user()->telefono == "" || Auth::user()->nickname == "") {
                Toastr::info('¡Completa tu información para continuar!', '¡Alerta!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                return redirect('perfil');
            }
        }
        return $next($request);
    }
}
