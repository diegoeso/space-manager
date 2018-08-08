<?php

namespace App\Http\Controllers\Admins;

use App;
use App\Http\Controllers\Controller;
use App\Usuario;
use PDF;

class PdfController extends Controller
{
    public function administradores()
    {
        $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Ah perrrooo</h1>');
        $data = Usuario::orderBy('carrera', 'DESC')->orderBy('semestre', 'DESC')->get();
        // dd($data);
        $pdf = PDF::loadView('admins.administradores.pdf', ['data' => $data]);
        return $pdf->stream();
    }

}
