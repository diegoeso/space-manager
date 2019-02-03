<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Route::resourceVerbs([
            'create' => 'crear',
            'edit'   => 'editar',
        ]);

        Schema::defaultStringLength(120);
        // notificaciones de solicitudes para administrativos
        view()->composer('layouts.headerAdmin', function ($view) {
            $view->with('notificaciones', \App\Notificacion::whereHas('solicitud', function ($query) {
                $query->where('usuarioSolicitud', '!=', Auth::user()->id)
                    ->where('estado', 0);
            })
                    ->where('estadoAdmin', 0)
                    ->orderBy('id', 'DESC')
                    ->get());
        });


        // notificar a responsables de area
        view()->composer('layouts.headerAdmin', function ($view) {
            $view->with('notificacionesAprobadas', \App\Notificacion::whereHas('solicitud', function ($query) {
                $query->where('usuarioSolicitud', '!=', Auth::user()->id)
                    ->where('estado', 1)
                    ->whereHas('area', function ($query) {
                        $query->where('user_id', Auth::user()->id)
                            ->groupBy('user_id')
                        ;})
                ;})
                    ->where('estadoRes', 0)
                    ->orderBy('id', 'DESC')
                    ->get());
        });

        // Notificacion a usuarios
        view()->composer('layouts.headerUser', function ($view) {
            $view->with('notificacionesAprobadas', \App\Notificacion::whereHas('solicitud', function ($query) {
                $query->where('usuarioSolicitud', '=', Auth::user()->id)
                    ->where('estado', 1);})
                    ->where('estadoUsu', 0)
                    ->orderBy('id', 'DESC')
                    ->get());
        });

        view()->composer('layouts.asideUser', function ($view) {
            $view->with('evaluaciones', \App\Evaluaciones::where('evaluador', Auth::user()->id)->where('estado', 0)->get());
        });

        view()->composer('layouts.asideAdmin', function ($view) {
            $view->with('evaluaciones', \App\Evaluaciones::where('evaluador', Auth::user()->id)->where('estado', 0)->get());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
