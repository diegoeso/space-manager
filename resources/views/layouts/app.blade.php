<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <title>
            Space Manager | Bienvenido
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        <!-- Bootstrap 3.3.7 -->
        <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
        {{-- Toastr --}}
        <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
        <!-- Ionicons -->
        <link href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="{{ asset('dist/css/AdminLTE.css') }}" rel="stylesheet"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
        <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet"/>
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
        </link>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        </link>
    </head>
    <style>
        html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding-top: 150px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 50px;
            }
    </style>
    <body class="hold-transition skin-blue layout-top-nav" id="login">
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-default ">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" style="color: #fff" type="button">
                                <span class="sr-only">
                                    Toggle navigation
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                            </button>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <b>
                                    Space
                                </b>
                                Manager
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            @if (Route::has('login'))
                            <ul class="nav navbar-nav navbar-right">
                                @auth
                                <li>
                                    @if (Auth::user()->tipoCuenta==0 || Auth::user()->tipoCuenta==1)
                                    <a href="{{ url('/admin') }}">
                                        Inicio
                                    </a>
                                    @else
                                    <a href="{{ url('/inicio') }}">
                                        Inicio
                                    </a>
                                    @endif
                                </li>
                                @else
                                <li>
                                    <a href="{{ route('login') }}">
                                        Iniciar Sesión
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">
                                        Registrarse
                                    </a>
                                </li>
                                @endauth
                            </ul>
                            @endif
                        </div>
                    </div>
                </nav>
            </header>
        </div>
    </body>
</html>
<div class="content-wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>
<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>
                Version
            </b>
            2.0
        </div>
        <strong>
            Copyright © 2017-2018
            <a href="https://www.facebook.com/diego.enriqueSO" target="_back">
                Diego Enrique Sanchez Ordoñez
            </a>
            .
        </strong>
        All rights reserved.
    </div>
</footer>
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}">
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}">
</script>
{{-- Toastr --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}">
</script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}">
</script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}">
</script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}">
</script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}">
</script>
{!! Toastr::message() !!}
