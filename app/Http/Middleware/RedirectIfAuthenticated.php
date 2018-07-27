<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         return redirect('/home');
    //     }

    //     return $next($request);
    // }
    //
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'usuario':
                if (Auth::guard($guard)->check()) {
                    // return redirect()->route('dashboard');
                    return redirect('/inicio');
                }
                break;
            case 'web':
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin');
                }
                break;

            case 'guest':
                return redirect()->route('usuarios.login');
                break;
            default:
                // if (Auth::guard($guard)->check()) {
                //     return redirect('/inicio');
                // }
                break;
        }

        return $next($request);
    }
}
