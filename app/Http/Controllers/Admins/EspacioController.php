<?php

namespace App\Http\Controllers\Admins;

use App;
use App\Area;
use App\CategoriaElemento;
use App\Espacio;
use App\Exports\EspaciosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspacioRequest;
use App\Imports\EspaciosImport;
use App\Solicitud;
use App\Traits\Alertas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Toastr;
use Yajra\DataTables\DataTables;

class EspacioController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:espacios.index')->only('index');
        $this->middleware('permission:espacios.create')->only(['create', 'store']);
        $this->middleware('permission:espacios.show')->only('show');
        $this->middleware('permission:espacios.edit')->only(['edit', 'update']);
        $this->middleware('permission:espacios.destroy')->only('destroy');
        Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.espacios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaElemento::pluck('nombre', 'id');
        $areas      = Area::all()->pluck('nombre', 'id');
        return view('admins.espacios.create', compact('areas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspacioRequest $request)
    {
        // $espacio              = Espacio::create($request->all());
        $espacio              = new Espacio();
        $espacio->nombre      = $request->nombre;
        $espacio->ubicacion   = $request->ubicacion;
        $espacio->area_id     = $request->area_id;
        $espacio->disponible  = $request->disponible;
        $espacio->descripcion = $request->descripcion;

        if ($espacio->save()) {
            if ($request->cantidad) {
                $manyToMany = array();
                for ($i = 0; $i < count($request->cantidad); $i++) {
                    $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
                }
                $espacio->elementos()->sync($manyToMany);
            }
            $this->registroExitoso();
            return redirect()->route('espacios.show', $espacio->id);
        } else {
            return back();
            $this->registroError();
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
        $espacio = Espacio::find($id);
        if (!$espacio) {
            return abort(404);
        }

        return view('admins.espacios.show', compact('espacio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $espacio = Espacio::find($id);
        $areas   = Area::pluck('nombre', 'id');
        if (!$espacio) {
            return abort(404);
        }

        return view('admins.espacios.edit', compact('espacio', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $espacio              = Espacio::find($id);
        $espacio->nombre      = $request->nombre;
        $espacio->descripcion = $request->descripcion;
        $espacio->ubicacion   = $request->ubicacion;
        $espacio->disponible  = $request->disponible;
        $espacio->area_id     = $request->area_id;

        if ($espacio->save()) {
            if ($request->cantidad) {
                $manyToMany = array();
                for ($i = 0; $i < count($request->cantidad); $i++) {
                    $manyToMany[$request->elemento_id[$i]] = ['cantidad' => $request->cantidad[$i]];
                }
                $espacio->elementos()->sync($manyToMany);
            }
            $this->registroExitoso();
            return redirect()->route('espacios.show', $espacio->id);
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
        $espacio = Espacio::FindOrFail($id);
        $result  = $espacio->delete();
        if ($result) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function listarEspacios($id)
    {
        $espacios = Espacio::all();
        return Datatables::of($espacios)
            ->editColumn('area_id', function ($espacios) {
                return $espacios->area->nombre;
            })
            ->addColumn('action', function ($espacios) {
                return '<a href="' . route("espacios.show", $espacios->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                '<a href="' . route('espacios.edit', $espacios->id) . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                '<a href="#" value="' . $espacios->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function espacios()
    {
        $fecha = date('d-m-Y/h:i:s');
        $pdf   = App::make('dompdf.wrapper');
        $data  = Espacio::all();
        // dd($data);
        $pdf = PDF::loadView('admins.espacios.pdf', ['data' => $data]);
        // return $pdf->stream();
        return $pdf->download('espacios_' . $fecha . '.pdf');
    }

    public function estadisticas(Request $request)
    {
        $data = [];
        for ($i = 0; $i < count($request->espacio_e); $i++) {
            $subArr = $request->espacio_e[$i];
            array_push($data, $subArr);
        }
        $fechaInicio = Carbon::parse($request->fechaI)->format('Y-m-d');
        $fechaFin    = Carbon::parse($request->fechaF)->format('Y-m-d');
        $espacios    = Solicitud::where('tipoRegistro', 0)
            ->where(function ($query) {
                $query->where('estado', '=', 1)
                    ->orWhere('estado', '=', 4);
            })
            ->whereIn('espacio_id', $data)
            ->whereBetween('fechaInicio', [$fechaInicio, $fechaFin])->get();
        if (count($espacios) > 0) {
            $fecha = date('d-m-Y/h:i:s');
            $pdf   = App::make('dompdf.wrapper');
            $pdf   = PDF::loadView('admins.espacios.espacios_utilizados_pdf', ['espacios' => $espacios])->setPaper('a4', 'landscape');
            return $pdf->stream();
        } else {
            Toastr::warning('¡No se encontraron registros!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
            return back();
        }

    }

    public function mostrar_estadisticas(Request $request)
    {
        $espaciosE = Espacio::pluck('nombre', 'id');
        return view('admins.espacios.estadisticas', compact('espaciosE'));
    }

    public function export()
    {
        return Excel::download(new EspaciosExport, 'espacios.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new EspaciosImport, $request->file('file'));
        Toastr::success('¡Importación exitosa!', '¡Hecho!', ["positionClass" => "toast-top-right", "closeButton" => 'true', "progressBar" => 'true']);
        return back();
    }

}
