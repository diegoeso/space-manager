<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Traits\Alertas;
use App\User;
use App\Usuario;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CorreosController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.email.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mensajes_sin_leer = Mensaje::where('leido', 0)->get();
        return view('admins.email.create', compact('mensajes_sin_leer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = new Mensaje();
        $mensaje->para = $request->para_email;
        $mensaje->de = Auth::user()->email;
        $mensaje->asunto = $request->asunto;
        $mensaje->mensaje = $request->mensaje;
        $mensaje->leido = 0;
        if ($mensaje->save()) {
            $this->mensajeExitoso();
        } else {
            $this->mensajeError();
        }
        return redirect()->route('correo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mensaje = Mensaje::find($id);
        $de = Usuario::where('email', $mensaje->de)->first();
        $para = User::where('email', $mensaje->para)->first();
        $mensaje->leido = 1;
        $mensaje->save();

        $mensajes_sin_leer = Mensaje::where('leido', 0)->get();
        return view('admins.email.show', compact('mensaje', 'de', 'para', 'mensajes_sin_leer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function responder($id)
    {
        $mensaje = Mensaje::find($id);
        $user=Usuario::where('email', $mensaje->de)->first();
        return view('admins.email.create', compact( 'mensaje','user'));
    }

    public function delete($id)
    {
        $mensaje   = Mensaje::FindOrFail($id);
        $mensaje->delete_para_a   = 1;
        if ($mensaje->save()) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    public function delete_de($id)
    {
        $mensaje   = Mensaje::FindOrFail($id);
        $mensaje->delete_de_a   = 1;
        if ($mensaje->save()) {
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('usuarios')
                ->where('nombre', 'LIKE', "%{$query}%")
                ->orwhere('email', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '<li><a href="#" value="'.$row->email.'">'.$row->nombre.' '.$row->apellidoP.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }


    public function entrada($email)
    {

        $entrada = Mensaje::where('para', $email)->where('delete_para_a', '!=', 1)->orderBy('id','DESC');
        return Datatables::of($entrada)
            ->editColumn('de',function ($entrada){
                $user=Usuario::where('email',$entrada->de)->first();
                return $user->fullName;
            })
            ->setRowClass(function ($entrada) {
                return $entrada->leido == 0 ? 'text-blue' : 'text-default';
            })
            ->addColumn('mensaje_res', function ($entrada) {
                return $entrada->asunto . ' -  ' . substr($entrada->mensaje, 0, 50) . '...';;
            })
            ->editColumn('created_at', function ($entrada){
                return $entrada->created_at->format('j F Y');
            })
            ->addColumn('action', function ($entrada) {
                return '<a href="' . route("correo.show", $entrada->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                    '<a href="#" value="' . $entrada->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

    public function enviados()
    {
        return view('admins.email.salida');
    }

    public function salida($email)
    {
        $salida = Mensaje::where('de', $email)->where('delete_de_a','!=',1)->orderBy('created_at','DESC');
        return Datatables::of($salida)
            ->editColumn('para',function ($salida){
                $user=Usuario::where('email',$salida->para)->first();
                return $user->fullName;
            })
            ->addColumn('mensaje_res', function ($salida) {
                return $salida->asunto . ' -  ' . substr($salida->mensaje, 0, 50) . '...';;
            })
            ->editColumn('created_at', function ($salida){
                return $salida->created_at->format('j F Y');
            })
            ->addColumn('action', function ($salida) {
                return '<a href="' . route("correo.show", $salida->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                    '<a href="#" value="' . $salida->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }


    public function eliminados()
    {
        return view('admins.email.basura');
    }

    public function correo_eliminado($email)
    {
        $salida = Mensaje::where('para', $email)
            ->where('delete_para_a',1)
            ->orWhere('delete_de_a',1)
            ->orderBy('updated_at','DESC');
        return Datatables::of($salida)
            ->editColumn('para', function ($salida) {
                if ($salida->para==Auth::user()->email)
                {
                    return Auth::user()->fullName;
                }else
                {
                    return $salida->para;
                }
            })
            ->editColumn('updated_at', function ($salida){
                return $salida->updated_at->format('j F Y');;
            })
            ->addColumn('mensaje_res', function ($salida) {
                return $salida->asunto . ' -  ' . substr($salida->mensaje, 0, 50) . '...';;
            })
            ->addColumn('action', function ($salida) {
                return '<a href="' . route("correo.show", $salida->id) . '" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                    '<a href="#" value="' . $salida->id . '" class="btn btn-danger btn-xs" id="btnEliminar"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);
    }

}
