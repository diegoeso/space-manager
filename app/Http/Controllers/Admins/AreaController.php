<?php

namespace App\Http\Controllers\Admins;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Traits\Alertas;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AreaController extends Controller
{
    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:areas.index')->only('index');
        $this->middleware('permission:areas.create')->only(['create', 'store']);
        $this->middleware('permission:areas.show')->only('show');
        $this->middleware('permission:areas.edit')->only(['edit', 'update']);
        $this->middleware('permission:areas.destroy')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $areas = Area::orderBy('id', 'desc')
        //     ->paginate();
        return view('admins.areas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsables = User::where('tipoCuenta', '1')->pluck('nombreCompleto', 'id');
        return view('admins.areas.create', compact('responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $area              = new Area;
        $area->nombre      = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->user_id     = $request->user_id;
        if ($area->save()) {
            $this->registroExitoso();
            return redirect()->route('areas.show', $area->id);
        } else {
            $this->registroError();
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

        $area = Area::find($id);
        return view('admins.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $responsables = User::where('tipoCuenta', '1')->pluck('nombreCompleto', 'id');
        $area         = Area::find($id);
        return view('admins.areas.edit', compact('area', 'responsables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $area              = Area::find($id);
        $area->nombre      = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->user_id     = $request->user_id;

        if ($area->save()) {
            $this->registroExitoso();
            return redirect()->route('areas.show', $area->id);
        } else {
            $this->registroError();
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
        $area   = Area::FindOrFail($id);
        $result = $area->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarAreas($id)
    {
        $areas = Area::all();
        return Datatables::of($areas)
            ->editColumn('user_id', function ($areas) {
                return $areas->responsables->nombre . ' ' . $areas->responsables->apellidoP . ' ' . $areas->responsables->apellidoM;
            })

            ->addColumn('idShow', function ($areas) {
                return $areas->id;
            })

            ->addColumn('action', function ($areas) {
                return '<a href="' . route("areas.show", $areas->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('areas.edit', $areas->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $areas->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }
}
