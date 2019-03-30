<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Usuario;
use Auth;
// use Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use App\Traits\Alertas;

class RegisterController extends Controller
{
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

    use RegistersUsers;
    
    public function showRegistrationForm()
    {
        //return view('auth.register');
        return view('auth.registro');
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

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
            // 'email'     => 'required|string|email|max:255|unique:usuarios,email|regex:/(.*)uaemex\.mx/i',
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
            'foto'               => 'user.png',
            'confirmacion'       => $data['confirmacion'],
            'codigoConfirmacion' => $data['codigoConfirmacion'],
        ]);

        return $usuario;
    }
}
