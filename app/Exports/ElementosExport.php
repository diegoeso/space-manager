<?php

namespace App\Exports;

use App\Elemento;
use Maatwebsite\Excel\Concerns\FromCollection;

class ElementosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Elemento::all();
    }
}
