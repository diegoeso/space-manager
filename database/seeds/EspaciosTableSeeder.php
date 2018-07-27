<?php

use App\Espacio;
use Illuminate\Database\Seeder;

class EspaciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Espacio::class, 10)->create();
    }
}
