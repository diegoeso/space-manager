<?php

namespace App\Http\Controllers\Admins;

use App;
use App\CategoriaElemento;
use App\Elemento;
use App\Http\Controllers\Controller;
use App\Http\Requests\ElementoRequest;
use App\Traits\Alertas;
use Illuminate\Http\Request;
use PDF;
use Yajra\DataTables\DataTables;

class ElementoController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:elementos.index')->only('index');
        $this->middleware('permission:elementos.create')->only(['create', 'store']);
        $this->middleware('permission:elementos.show')->only('show');
        $this->middleware('permission:elementos.edit')->only(['edit', 'update']);
        $this->middleware('permission:elementos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elementos = Elemento::orderBY('id', 'DESC')
            ->paginate();
        return view('admins.elementos.index', compact('elementos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = CategoriaElemento::pluck('nombre', 'id');
        return view('admins.elementos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElementoRequest $request)
    {
        $elemento                   = new Elemento;
        $elemento->nombre           = $request->nombre;
        $elemento->descripcion      = $request->descripcion;
        $elemento->numeroInventario = $request->numeroInventario;
        $elemento->categoria_id     = $request->categoria_id;
        if ($elemento->save()) {
            $this->registroExitoso();
            return redirect()->route('elementos.show', $elemento->id);
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
        $elemento = Elemento::find($id);
        if(!$elemento) return abort(404);
        return view('admins.elementos.show', compact('elemento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $elemento   = Elemento::find($id);
        $categorias = CategoriaElemento::pluck('nombre', 'id');
        if(!$elemento) return abort(404);
        return view('admins.elementos.edit', compact('elemento', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ElementoRequest $request, $id)
    {
        $elemento                   = Elemento::find($id);
        $elemento->nombre           = $request->nombre;
        $elemento->descripcion      = $request->descripcion;
        $elemento->numeroInventario = $request->numeroInventario;
        $elemento->categoria_id     = $request->categoria_id;

        if ($elemento->save()) {
            $this->registroExitoso();
            return redirect()->route('elementos.show', $elemento->id);
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
        $elemento = Elemento::FindOrFail($id);
        $result   = $elemento->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarElementos($id)
    {

        $elementos = Elemento::all();
        return Datatables::of($elementos)
            ->editColumn('categoria_id', function ($elementos) {
                return $elementos->categoriaElemento->nombre;
            })
            ->addColumn('action', function ($elementos) {
                return '<a href="' . route("elementos.show", $elementos->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>  ' .
                '<a href="' . route('elementos.edit', $elementos->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $elementos->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make();
    }

    public function elementos()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = Elemento::all();
        $pdf   = PDF::loadView('admins.elementos.pdf', ['data' => $data]);
        // return $pdf->stream();

        return $pdf->download('elementos_' . $fecha . '.pdf');
    }
}
