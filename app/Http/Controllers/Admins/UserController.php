<?php

namespace App\Http\Controllers\Admins;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Traits\Alertas;
use App\User;
use Auth;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use PDF;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.create')->only(['create', 'store']);
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.edit')->only(['edit', 'update']);
        $this->middleware('permission:users.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.administradores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admins.administradores.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user               = new User;
        $user->nombre       = $request->nombre;
        $user->apellidoP    = $request->apellidoP;
        $user->apellidoM    = $request->apellidoM;
        $user->nickname     = $request->nickname;
        $user->email        = $request->email;
        $user->telefono     = $request->telefono;
        $user->password     = bcrypt($request->password);
        $user->confirmacion = 1;
        if ($request->roles == 1) {
            $user->tipoCuenta = 0;
        } else {
            $user->tipoCuenta = 1;
        }
        if ($request->hasFile('foto')) {
            $user->foto = $request->file('foto')->store('public');
        }
        $user->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;
        if ($user->save()) {
            $user->roles()->sync($request->roles);
            $this->registroExitoso();
            return redirect()->route('users.show', $user->id);
        } else {
            $this->registroError();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::with('roles')->find($id);
        if (!$user) {
            return abort(404);
        }
        return view('admins.administradores.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::pluck('name', 'id');
        $user  = User::with('roles')->find($id);
        if (!$user) {
            return abort(404);
        }
        return view('admins.administradores.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        // dd($request->role);
        $user            = User::find($id);
        $user->nombre    = $request->nombre;
        $user->apellidoP = $request->apellidoP;
        $user->apellidoM = $request->apellidoM;
        $user->nickname  = $request->nickname;
        $user->email     = $request->email;
        $user->telefono  = $request->telefono;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->confirmacion = 1;
        if ($request->roles == 1) {
            $user->tipoCuenta = 0;
        } else {
            $user->tipoCuenta = 1;
        }
        if ($request->hasFile('foto')) {
            $user->foto = $request->file('foto')->store('public');
        }
        $user->nombreCompleto = $request->nombre . ' ' . $request->apellidoP . ' ' . $request->apellidoM;
        if ($user->save()) {
            $user->roles()->sync($request->roles);
            $this->registroExitoso();
            return redirect()->route('users.show', $user->id);
        } else {
            $this->registroError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user   = User::FindOrFail($id);
        $result = $user->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarUsers($id)
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return Datatables::of($users)
            ->editColumn('nombre', function ($users) {
                return $users->nombre . ' ' . $users->apellidoP . ' ' . $users->apellidoM;
            })
            ->editColumn('tipoCuenta', function ($users) {
                if ($users->tipoCuenta == 0) {
                    return 'Administrador';
                } else {
                    return 'Responsable de Area';
                }
            })
            ->addColumn('action', function ($users) {
                return '<a href="' . route("users.show", $users->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('users.edit', $users->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $users->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function administradores()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = User::all();
        $pdf   = PDF::loadView('admins.administradores.pdf', ['data' => $data]);
        return $pdf->stream();
        // return $pdf->download('administradores_' . $fecha . '.pdf');
    }

}
