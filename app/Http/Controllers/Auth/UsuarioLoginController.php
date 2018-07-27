<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Toastr;

class UsuarioLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.loginU');
    }

    public function login(Request $request)
    {
        // Valiada los datos del formulario
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Inicio de sesion con el usuario
        if (Auth::guard('usuario')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // redirige a la vista correspondiente
            Toastr::info('Bievenido', 'Inicio de Sesión', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return redirect()->intended(route('dashboard'));
        }
        Toastr::error('Estas credenciales no coinciden con nuestros registros.', '¡Error!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        // si no redirige a la venta inicial
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('usuario')->logout();
        return redirect('/');
    }
}
