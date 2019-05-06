<?php

use App\Solicitud;
use Illuminate\Database\Seeder;

class SolicitudesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Solicitud::class, 300)->create();
    }
}
