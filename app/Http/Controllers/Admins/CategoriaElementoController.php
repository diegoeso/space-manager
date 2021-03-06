<?php

namespace App\Http\Controllers\Admins;

use App;
use App\CategoriaElemento;
use App\Exports\CategoriasElementoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaElementosRequest;
use App\Imports\CategoriasElementoImport;
use App\Traits\Alertas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Toastr;
use Yajra\DataTables\DataTables;

class CategoriaElementoController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:categoria-elementos.index')->only('index');
        $this->middleware('permission:categoria-elementos.create')->only(['create', 'store']);
        $this->middleware('permission:categoria-elementos.show')->only('show');
        $this->middleware('permission:categoria-elementos.edit')->only(['edit', 'update']);
        $this->middleware('permission:categoria-elementos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.categoria-elementos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.categoria-elementos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaElementosRequest $request)
    {
        $categoria              = new CategoriaElemento;
        $categoria->nombre      = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->permisos    = 1;

        if ($categoria->save()) {
            $this->registroExitoso();
            return redirect()->route('categoria-elementos.show', $categoria->id);
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
        $categoria = CategoriaElemento::find($id);
        if (!$categoria) {
            return abort(404);
        }

        return view('admins.categoria-elementos.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = CategoriaElemento::find($id);
        if (!$categoria) {
            return abort(404);
        }

        return view('admins.categoria-elementos.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaElementosRequest $request, $id)
    {
        $categoria              = CategoriaElemento::find($id);
        $categoria->nombre      = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->permisos    = 1;

        if ($categoria->save()) {
            $this->registroExitoso();
            return redirect()->route('categoria-elementos.show', $categoria->id);
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
        $categoria = CategoriaElemento::FindOrFail($id);
        $result    = $categoria->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarCategorias($id)
    {
        // $descripcion= substr($categoria->descripcion, 0,100);
        $categoria = CategoriaElemento::all();
        return Datatables::of($categoria)
            ->editColumn('descripcion', function ($categoria) {
                return substr($categoria->descripcion, 0, 150) . '...';
            })
            ->addColumn('action', function ($categoria) {
                return '<a href="' . route("categoria-elementos.show", $categoria->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>  ' .
                '<a href="' . route('categoria-elementos.edit', $categoria->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $categoria->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make();
    }

    public function categoria_elementos()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = CategoriaElemento::all();
        $pdf   = PDF::loadView('admins.categoria-elementos.pdf', ['data' => $data]);
        // return $pdf->stream();
        return $pdf->download('categorias_' . $fecha . '.pdf');
    }

    public function export()
    {
        return Excel::download(new CategoriasElementoExport, 'categorias.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new CategoriasElementoImport, $request->file('file'));
        Toastr::success('¡Importación exitosa!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }
}
