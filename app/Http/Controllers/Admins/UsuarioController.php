<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Traits\Alertas;
use App\Usuario;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:usuarios.index')->only('index');
        $this->middleware('permission:usuarios.create')->only(['create', 'store']);
        $this->middleware('permission:usuarios.show')->only('show');
        $this->middleware('permission:usuarios.edit')->only(['edit', 'update']);
        $this->middleware('permission:usuarios.destroy')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.usuarios.create');
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(UsuarioRequest $request)
    {
        $usuario                     = new Usuario;
        $usuario->nombre             = $request->nombre;
        $usuario->apellidoP          = $request->apellidoP;
        $usuario->apellidoM          = $request->apellidoM;
        $usuario->nickname           = $request->nickname;
        $usuario->email              = $request->email;
        $usuario->password           = bcrypt($request->password);
        $usuario->confirmacion       = 0;
        $usuario->codigoConfirmacion = trim(str_random(45));
        $usuario->tipoCuenta         = $request->tipoCuenta;
        $usuario->telefono           = $request->telefono;
        if ($request->hasFile('foto')) {
            $usuario->foto = $request->file('foto')->store('public');
        }
        $usuario->foto      = 'user.png';
        $usuario->carrera   = $request->carrera;
        $usuario->semestre  = $request->semestre;
        $usuario->matricula = $request->matricula;
        if ($usuario->save()) {
            $this->regsitroExitoso();
            return redirect()->route('usuarios.show', $usuario->id);
        } else {
            $this->regsitroError();
            return back();
        }
    }

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id)
    {

        $usuario = Usuario::find($id);
        if (!isset($usuario)) {
            return abort(404);
        }
        return view('admins.usuarios.show', compact('usuario'));
    }

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function edit($id)
    {

        $usuario = Usuario::find($id);
        return view('admins.usuarios.edit', compact('usuario'));
    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario            = Usuario::find($id);
        $usuario->nombre    = $request->nombre;
        $usuario->apellidoP = $request->apellidoP;
        $usuario->apellidoM = $request->apellidoM;
        $usuario->nickname  = $request->nickname;
        $usuario->email     = $request->email;
        if (!empty($request->password)) {
            $usuario->password = bcrypt($request->password);
        }
        // $usuario->tipoCuenta = $request->tipoCuenta;
        if ($request->hasFile('foto')) {
            $usuario->foto = $request->file('foto')->store('public');
        }
        $usuario->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;
        $usuario->confirmacion   = $request->confirmacion;
        $usuario->carrera        = $request->carrera;
        $usuario->semestre       = $request->semestre;
        $usuario->matricula      = $request->matricula;

        if ($usuario->save()) {
            $this->regsitroExitoso();
            return redirect()->route('usuarios.show', $usuario->id);
        } else {
            $this->regsitroError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::FindOrFail($id);
        $result  = $usuario->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarUsuarios($id)
    {
        $usuarios = Usuario::all();

        return view('admins.usuarios.index', compact('usuarios'));

        return Datatables::of($usuarios)
            ->editColumn('nombre', function ($usuarios) {
                return $usuarios->FullName;
            })

            ->editColumn('carrera', function ($usuarios) {
                return $usuarios->nombreCarrera($usuarios->carrera);
            })
            ->addColumn('action', function ($usuarios) {
                return '<a href="' . route("usuarios.show", $usuarios->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('usuarios.edit', $usuarios->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $usuarios->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }
}
