<?php

namespace App\Http\Controllers\Admins;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Traits\Alertas;
use App\Usuario;
use PDF;
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

    public function index()
    {
        return view('admins.usuarios.index');
    }

    public function create()
    {
        return view('admins.usuarios.create');
    }

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
            $this->registroExitoso();
            return redirect()->route('usuarios.show', $usuario->id);
        } else {
            $this->registroError();
            return back();
        }
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return abort(404);
        }
        return view('admins.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return abort(404);
        }
        return view('admins.usuarios.edit', compact('usuario'));
    }

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
        if ($request->hasFile('foto')) {
            $usuario->foto = $request->file('foto')->store('public');
        }
        $usuario->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;
        $usuario->confirmacion   = $request->confirmacion;
        $usuario->carrera        = $request->carrera;
        $usuario->semestre       = $request->semestre;
        $usuario->matricula      = $request->matricula;

        if ($usuario->save()) {
            $this->registroExitoso();
            return redirect()->route('usuarios.show', $usuario->id);
        } else {
            $this->registroError();
            return back();
        }
    }

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

    public function usuarios()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = Usuario::orderBy('carrera', 'ASC')->orderBy('semestre', 'ASC')->get();
        $pdf   = PDF::loadView('admins.usuarios.pdf', ['data' => $data]);
        // return $pdf->stream();
        return $pdf->download('usuarios_' . $fecha . '.pdf');
    }
}
