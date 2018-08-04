<?php

namespace App\Http\Middleware;

// use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class ConfirmarCuenta
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->$auth->$user()->telefono == "") {
            return redirect('perfil');
        }
        return $next($request);

    }
}
