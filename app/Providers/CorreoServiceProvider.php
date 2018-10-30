<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class CorreoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.headerAdmin', function ($view) {
            $view->with('correo', \App\Mensaje::where('para', Auth::user()->email)
                    ->where('leido', 0)
                    ->orderBy('id', 'DESC')
                    ->get());
        });

        view()->composer('admins.*', function ($view) {
            $view->with('correo', \App\Mensaje::where('para', Auth::user()->email)
                    ->where('leido', 0)
                    ->orderBy('id', 'DESC')
                    ->get());
        });

        view()->composer('admins.*', function ($view) {
            $view->with('correo_enviado', \App\Mensaje::where('de', Auth::user()->email)
                    ->where('delete_de_a','!=',1)
                    ->orderBy('id', 'DESC')
                    ->get());
        });

        view()->composer('admins.*', function($view){
            $view->with('correo_eliminado', \App\Mensaje::where('delete_para_a', 1)->orWhere('delete_de_a',1)->get
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
