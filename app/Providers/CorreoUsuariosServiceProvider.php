<?php

namespace App\Providers;

use function foo\func;
use Illuminate\Support\ServiceProvider;
use Auth;
use DB;

class CorreoUsuariosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.headerUser', function ($view) {
            $view->with('correo_usuarios', \App\Mensaje::where('para', Auth::user()->email)
                ->where('leido', 0)
                ->orderBy('id', 'DESC')
                ->get());
        });

        view()->composer('usuarios.*', function ($view) {
            $view->with('correo_usuarios', \App\Mensaje::where('para', Auth::user()->email)
                ->where('leido', 0)
                ->orderBy('id', 'DESC')
                ->get());
        });

        view()->composer('usuarios.*', function ($view) {
            $view->with('correo_enviado_usuarios', \App\Mensaje::where('de', Auth::user()->email)
                ->where('delete_de_u','!=',1)
                ->orderBy('id', 'DESC')
                ->get());
        });

        //Correos electronicos administrativos
        view()->composer('usuarios.*', function ($view){
            $view->with('correos_admins', \App\User::all());
        });


        //mensajes eliminados
        view()->composer('usuarios.*', function($view){
            $view->with('mensajes_eliminados', \App\Mensaje::where('delete_para_u', 1)->orWhere('delete_de_u',1)->get
            ());
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
