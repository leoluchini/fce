<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;
class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['codigo'=> 'soc', 'nombre' => 'Social', 'descripcion' => 'Categoria Social']);
        Categoria::create(['codigo'=> 'pro', 'nombre' => 'Produccion', 'descripcion' => 'Categoria Produccion']);
        Categoria::create(['codigo'=> 'fis', 'nombre' => 'Fiscal', 'descripcion' => 'Categoria Fiscal']);
        Categoria::create(['codigo'=> 'dem', 'nombre' => 'Demografica', 'descripcion' => 'Categoria Demografica']);
    }
}
