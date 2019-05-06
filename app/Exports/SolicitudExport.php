<?php

namespace App\Exports;

use App\Solicitud;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SolicitudExport implements FromView
{
    public function view(): View
    {
        return view('admins.solicitudes.export', [
            'solicitudes' => Solicitud::where('tipoRegistro', 0)->get(),
        ]);
    }
}
