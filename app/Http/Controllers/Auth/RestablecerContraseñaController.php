<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Usuario;
use Illuminate\Http\Request;
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

            }
        } else {
            $usuario = Usuario::where('email', $request->email)->first();
            if ($usuario) {
                $usuario->password = bcrypt(trim(str_random(6)));
                $usuario->save();
                $data['nombre']     = $usuario->fullName;
                $data['tipoCuenta'] = $usuario->tipoCuenta;
                $data['password']   = trim(str_random(6));

                Toastr::info('¡Hemos enviado un correo con la informacion necesaria.!', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            } else {
                Toastr::error('El Correo Electronico no existe en nuestra base de datos', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
                // return back();
            }

        }

    }
}
