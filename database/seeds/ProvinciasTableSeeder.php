<?php

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Buenos Aires']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Catamarca']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Chaco']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Chubut']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Córdoba']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Corrientes']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Entre Ríos']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Formosa']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Jujuy']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'La Pampa']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'La Rioja']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Mendoza']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Misiones']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Neuquén']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Río Negro']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Salta']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'San Juan']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'San Luis']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Santa Cruz']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Santa Fe']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Santiago del Estero']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Tierra del Fuego, Antártida e Isla del Atlántico Sur']);
        Provincia::create(['zona_padre_id' => 1, 'nombre' => 'Tucumán']);
    }
}
