<?php

namespace App\Imports;

use App\CategoriaElemento;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriasElementoImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CategoriaElemento([
            'nombre'      => $row[0],
            'descripcion' => $row[1],
            'permisos'    => $row[2],
        ]);
    }
}
