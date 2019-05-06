<?php

namespace App\Exports;

use App\Area;
use Maatwebsite\Excel\Concerns\FromCollection;

class AreasExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Area::all();
    }
}
