<?php

namespace App\Imports;

use App\Espacio;
use Maatwebsite\Excel\Concerns\ToModel;

class EspaciosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Espacio([
            'nombre'      => $row[0],
            'descripcion' => $row[1],
            'ubicacion'   => $row[2],
            'disponible'  => $row[3],
            'area_id'     => $row[4],
        ]);
    }
}
