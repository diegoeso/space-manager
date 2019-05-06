<?php

namespace App\Imports;

use App\Elemento;
use Maatwebsite\Excel\Concerns\ToModel;

class ElementosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Elemento([
            'nombre'           => $row[0],
            'descripcion'      => $row[1],
            'numeroInventario' => $row[2],
            'categoria_id'     => $row[3],
            'cantidad'         => $row[4],
            'solicitados'      => $row[5],
            'existencias'      => $row[6],
        ]);
    }
}
