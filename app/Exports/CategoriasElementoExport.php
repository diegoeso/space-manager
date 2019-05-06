<?php

namespace App\Exports;

use App\CategoriaElemento;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriasElementoExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CategoriaElemento::all();
    }
}
