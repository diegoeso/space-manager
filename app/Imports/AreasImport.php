<?php

namespace App\Imports;

use App\Area;
use Maatwebsite\Excel\Concerns\ToModel;

class AreasImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            return new Area([
                'nombre'      => $row[0],
                'descripcion' => $row[1],
                'user_id'     => $row[2],
            ]);
        } catch (Exception $e) {
            return 'Error';
        }

    }
}
