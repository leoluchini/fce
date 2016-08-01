<?php

use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create(['codigo'=> 1, 'nombre' => 'Argentina']);
    }
}
