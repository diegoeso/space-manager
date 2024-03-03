<?php

namespace App\Http\Controllers;

use App\Area;
use App\Evaluaciones;
use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Solicitud;
use App\Traits\Email;
use App\Usuario;
use Auth;
use Toastr;

class UsuarioController extends Controller
{

    use Email;

    public function __construct()
    {
        $this->middleware('auth:usuario');
        $this->middleware('confirmarCuenta:usuario')->only('dashboard');
    }

    public function dashboard()
    {
        $id           = Auth::user()->id;
        $areasE       = Area::pluck('nombre', 'id');
        $solicitudes  = Solicitud::where('usuarioSolicitud', $id)->get();
        $evaluaciones = Evaluaciones::where('evaluado', Auth::user()->id)->where('estado', 1)->get();
        $mensajes     = Mensaje::where('leido', 0)->where('para', Auth::user()->id)->get();
        return view('usuarios.dashboard', compact('solicitudes', 'areasE', 'evaluaciones', 'mensajes'));
    }

    public function confirmarCuenta()
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
            try {
                $this->enviarEmailRegistro($data);
            } catch (Exception $e) {
                return Toastr::error('No se pudo enviar el email de confirmación', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            }
            $usuario->envioEmail = 1;
            $usuario->save();
            return view('mail.confirmacion', compact('usuario'));
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
        $this->enviarEmailRegistro($data);
        Toastr::info('¡Te hemos enviado un nuevo correo de confirmacion!', '¡Hecho!', ["positionClass" => "toast-bottom-full-width", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }
}
