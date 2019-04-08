<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Usuario;
use Auth;
// use Hash;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Toastr;

// use App\Traits\Alertas;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    // use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.registro');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'inicio';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre'    => 'required|string|max:255',
            'apellidoP' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:usuarios,email|regex:/(.*)uaemex\.mx/i',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $data['codigoConfirmacion'] = trim(str_random(45));
        $data['confirmacion']       = 0;
        $usuario                    = Usuario::create([
            'nombre'             => $data['nombre'],
            'apellidoP'          => $data['apellidoP'],
            'apellidoM'          => $data['apellidoM'],
            'email'              => $data['email'],
            'password'           => Hash::make($data['password']),
            'tipoCuenta'         => $data['tipoCuenta'],
            'confirmacion'       => $data['confirmacion'],
            'codigoConfirmacion' => $data['codigoConfirmacion'],
        ]);
        return $usuario;
    }

    // Login
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);

        // return $this->registered($request, $user)
        // ?: redirect($this->redirectPath());
        Toastr::info('¡Te hemos enviado un nuevo correo de confirmacion!', '¡Hecho!', ["positionClass" => "toast-bottom-full-width", "closeButton" => 'true', "progressBar" => 'true']);
        return $this->registered($request, $user)
        ?: redirect()->route('dashboard');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('usuario');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
}
