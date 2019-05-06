<?php

namespace App\Exports;

use App\Espacio;
use Maatwebsite\Excel\Concerns\FromCollection;

class EspaciosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Espacio::all();
    }
}
