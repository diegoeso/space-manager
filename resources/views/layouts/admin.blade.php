<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>

        <meta content="{{ csrf_token() }}" name="csrf-token"/>
        
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <title>
            Space Manager
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        @include('layouts.links')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @if (Auth::user()->tipoCuenta==0 || Auth::user()->tipoCuenta==1)
                @include('layouts.headerAdmin')
            @else
                @include('layouts.headerUser')    
            @endif
            @if (Auth::user()->tipoCuenta==0 || Auth::user()->tipoCuenta==1)
                @include('layouts.asideAdmin')
            @else
                @include('layouts.asideUser')
            @endif
            <div class="content-wrapper">
                @yield('navegacion')
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>
                        Versión
                    </b>
                    2.0
                </div>
                <strong>
                    Copyright © 2017-2019
                    <a href="https://www.facebook.com/diego.enriqueSO" target="blank">
                        Diego Enrique Sánchez Ordoñez
                    </a>
                    .
                </strong>
                All rights reserved.
            </footer>
        </div>
        @include('layouts.scripts')
        {!! Toastr::message() !!}
    </body>
</html>
