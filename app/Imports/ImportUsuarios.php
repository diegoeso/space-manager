<?php

namespace App\Imports;

use App\Usuario;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUsuarios implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Usuario([

        ]);
    }
}
