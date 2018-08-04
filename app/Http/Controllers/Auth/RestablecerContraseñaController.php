<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PayUService\Exception;
use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;
use Toastr;

class RestablecerContraseñaController extends Controller
{

    public function showForm()
    {
        return view('auth.passwords.email');
    }

    public function enviarLink(Request $request)
    {
        $usuario = User::where('email', $request->email)->first();
        if ($usuario) {
            $contraseña       = str_random(6);
            $usuario->password = bcrypt($contraseña);
            $usuario->save();
            $data['nombre']     = $usuario->fullName;
            $data['email']      = $usuario->email;
            $data['tipoCuenta'] = $usuario->tipoCuenta;
            $data['password']   = $contraseña;
            try {
                Mail::send('mail.passwordReset', $data, function ($message) use ($data) {
                    $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                    $message->to($data['email'], $data['nombre']);
                    $message->subject('Restablecer Contraseña');
                });
                Toastr::info('¡Hemos enviado un correo con la información necesaria.!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                return back();
            } catch (Exception $e) {
                Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->fullName);
                Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
            }
        } else {
            $usuario = Usuario::where('email', $request->email)->first();
            if ($usuario) {
                $contraseña       = str_random(6);
                $usuario->password = bcrypt($contraseña);
                $usuario->save();
                $data['nombre']     = $usuario->fullName;
                $data['email']      = $usuario->email;
                $data['tipoCuenta'] = $usuario->tipoCuenta;
                $data['password']   = $contraseña;
                try {
                    Mail::send('mail.passwordReset', $data, function ($message) use ($data) {
                        $message->from('contacto@gdsoft.com.mx', 'Space Manager');
                        $message->to($data['email'], $data['nombre']);
                        $message->subject('Restablecer Contraseña');
                    });
                    Toastr::info('¡Hemos enviado un correo con la información necesaria.!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                    return back();
                } catch (Exception $e) {
                    Log::notice('No se pudo enviar correo de notificacion a: ' . $usuario->fullName);
                    Log::critical('Error al conectar al servidor de correo  ' . $e->getMessage());
                }
            }
        }
        Toastr::error('El Correo Electronico no existe en nuestra base de datos', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
    }
}
