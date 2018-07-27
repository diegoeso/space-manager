<?php

use App\CategoriaElemento;
use Illuminate\Database\Seeder;

class CategoriaElementosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CategoriaElemento::class, 5)->create();
    }
}
