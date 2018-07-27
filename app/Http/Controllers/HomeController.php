<?php

namespace App\Http\Controllers;

use App\Area;
use App\Evaluaciones;
use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Solicitud;
use App\SolicitudElementos;
use App\Usuario;
use Auth;
use Mail;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:usuario');

    }

    public function dashboard()
    {
        $id                 = Auth::user()->id;
        $areasE             = Area::pluck('nombre', 'id');
        $solicitudes        = Solicitud::where('usuarioSolicitud', $id)->get();
        $solicitudElementos = SolicitudElementos::where('usuarioSolicitud', $id)->get();
        $evaluaciones       = Evaluaciones::where('evaluado', Auth::user()->id)->where('estado', 1)->get();
        $mensajes           = Mensaje::where('leido', 0)
            ->where('para', Auth::user()->id)->get();
        if (Auth::user()->confirmacion == 0 && Auth::user()->codigoConfirmacion != null) {
            return redirect()->route('confirmacion');
        } else {
            if (Auth::user()->nombreCompleto == null || Auth::user()->nickname == null) {
                // carga la vista
                return view('usuarios.dashboard', compact('solicitudes', 'areasE', 'solicitudElementos', 'evaluaciones', 'mensajes'));
            }
        }
        return view('usuarios.dashboard', compact('solicitudes', 'areasE', 'solicitudElementos', 'evaluaciones', 'mensajes'));
    }
    public function index()
    {
        $usuario                    = Usuario::find(Auth::user()->id);
        $data['id']                 = $usuario->id;
        $data['nombre']             = $usuario->nombre;
        $data['apellidoP']          = $usuario->apellidoP;
        $data['email']              = $usuario->email;
        $data['confirmacion']       = $usuario->confirmacion;
        $data['codigoConfirmacion'] = $usuario->codigoConfirmacion;
        $data['tipoCuenta']         = $usuario->tipoCuenta;

        if ($usuario->confirmacion == 0) {
            if ($usuario->envioEmail == 1) {
                return view('mail.confirmacion', compact('usuario'));
            }
            Mail::send('mail.register', $data, function ($message) use ($data) {
                $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                $message->to($data['email'], $data['nombre']);
                $message->subject('Confirmacion de Correo Electronico');
            });
            $usuario->envioEmail = 1;
            $usuario->save();
            return view('mail.confirmacion', compact('usuario'));
        } else {
            return redirect('/inicio')->with('info', '¡Actualiza tus datos para continuar!');
        }
    }
    public function confirmacion($email, $codigoConfirmacion)
    {
        $usuario     = new Usuario;
        $the_usuario = $usuario->select()->where('email', $email)
            ->where('codigoConfirmacion', $codigoConfirmacion)->get();

        if (count($the_usuario) > 0) {
            $confirmacion       = 1;
            $codigoConfirmacion = null;
            $usuario->where('email', $email)
                ->update(['confirmacion' => $confirmacion, 'codigoConfirmacion' => $codigoConfirmacion]);
            return redirect('/inicio');
        } else {
            return redirect()->route('login');
        }
    }

    public function reenviarCorreo($id)
    {
        $usuario                    = Usuario::find($id);
        $data['id']                 = $usuario->id;
        $data['nombre']             = $usuario->nombre;
        $data['apellidoP']          = $usuario->apellidoP;
        $data['email']              = $usuario->email;
        $data['confirmacion']       = $usuario->confirmacion;
        $data['codigoConfirmacion'] = $usuario->codigoConfirmacion;
        $data['tipoCuenta']         = $usuario->tipoCuenta;
        Mail::send('mail.register', $data, function ($message) use ($data) {
            $message->from('contacto@gdsoft.com.mx', 'Space Manager');
            $message->to($data['email'], $data['nombre']);
            $message->subject('Confirmacion de Correo Electronico');
        });
        Toastr::success('¡Te hemos enviado un nuevo correo de confirmacion!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }
}
