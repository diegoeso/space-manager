<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Mensaje;
use App\Traits\Alertas;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Toastr;

class MensajesController extends Controller
{

    use Alertas;

    public function __construct()
    {
        $this->middleware('auth')->only('responder');
    }

    public function index()
    {
        $entrada = DB::table('mensajes')
            ->join('usuarios', 'usuarios.id', '=', 'mensajes.de')
            ->select('mensajes.*', 'usuarios.nombreCompleto as nombreDe')
            ->where('para', Auth::user()->id)
            ->orderBy('mensajes.id', 'DESC')
            ->paginate();

        $mensajes = Mensaje::where('leido', 0)
            ->where('para', Auth::user()->id)->get();

        $salida = DB::table('mensajes')
            ->join('users', 'users.id', '=', 'mensajes.de')
            ->select('mensajes.*', 'users.nombreCompleto as nombreDe')
            ->where('de', Auth::user()->id)
            ->orderBy('mensajes.id', 'DESC')
            ->get();

        return view('admins.email.index', compact('entrada', 'mensajes', 'salida'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mensajes = Mensaje::where('leido', 0)
            ->where('para', Auth::user()->id)->get();
        $salida = DB::table('mensajes')
            ->join('users', 'users.id', '=', 'mensajes.de')
            ->select('mensajes.*', 'users.nombreCompleto as nombreDe')
            ->where('de', Auth::user()->id)
            ->orderBy('mensajes.id', 'DESC')
            ->get();
        return view('admins.email.create', compact('mensajes', 'salida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $now   = Carbon::now();
        $fecha = $now->format('Y-m-d');
        $hora  = $now->format('H:i:s');

        $mensaje               = new Mensaje;
        $mensaje->de           = $request->de;
        $mensaje->para         = $request->para;
        $mensaje->asunto       = $request->asunto;
        $mensaje->mensaje      = $request->mensaje;
        $mensaje->solicitud_id = $request->solicitud_id;
        $mensaje->leido        = 0;

        if ($mensaje->save()) {
            $this->mensajeExitoso();
            return redirect()->route('mensajes.index');
        } else {
            $this->mensajeError();
            return redirect()->route('mensajes.index');
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
        $mensaje = Mensaje::find($id)
            ->join('usuarios', 'usuarios.id', '=', 'mensajes.de')
            ->where('para', Auth::user()->id)
            ->select('mensajes.*', 'usuarios.nombreCompleto as nombreDe', 'usuarios.email')
            ->where('mensajes.id', $id)
            ->get();

        $mensajeLeido        = Mensaje::find($id);
        $mensajeLeido->leido = 1;
        $mensajeLeido->save();
        $mensajes = Mensaje::where('leido', 0)
            ->where('para', Auth::user()->id)->get();
        return view('admins.email.show', compact('mensaje', 'mensajes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensaje = Mensaje::find($id);
        if ($mensaje->delete()) {
            Toastr::success('¡Mensaje eliminado exitosamente!', 'Eliminado!', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function responder($id)
    {

        $mensaje = Mensaje::find($id)
            ->join('usuarios', 'usuarios.id', '=', 'mensajes.de')
            ->where('para', Auth::user()->id)
            ->where('mensajes.id', $id)->first();

        $mensajes = Mensaje::where('leido', 0)
            ->where('de', Auth::user()->id)->get();

        return view('admins.email.create', compact('mensajes', 'mensaje'));
    }
}
