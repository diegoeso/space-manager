<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:usuario,web');
    }

    public function crearPDF()
    {
        $pdf = PDF::loadView('layouts.pdf');
        return $pdf->stream('archivo.pdf');
    }
}
