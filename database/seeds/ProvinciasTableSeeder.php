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
        Provincia::firstOrCreate(['codigo' => "AR02000", 'nombre' => 'CABA']);
        Provincia::firstOrCreate(['codigo' => "AR06000", 'nombre' => 'Buenos Aires']);
        Provincia::firstOrCreate(['codigo' => "AR10000", 'nombre' => 'Catamarca']);
        Provincia::firstOrCreate(['codigo' => "AR22000", 'nombre' => 'Chaco']);
        Provincia::firstOrCreate(['codigo' => "AR26000", 'nombre' => 'Chubut']);
        Provincia::firstOrCreate(['codigo' => "AR14000", 'nombre' => 'Córdoba']);
        Provincia::firstOrCreate(['codigo' => "AR18000", 'nombre' => 'Corrientes']);
        Provincia::firstOrCreate(['codigo' => "AR30000", 'nombre' => 'Entre Ríos']);
        Provincia::firstOrCreate(['codigo' => "AR34000", 'nombre' => 'Formosa']);
        Provincia::firstOrCreate(['codigo' => "AR38000", 'nombre' => 'Jujuy']);
        Provincia::firstOrCreate(['codigo' => "AR42000", 'nombre' => 'La Pampa']);
        Provincia::firstOrCreate(['codigo' => "AR46000", 'nombre' => 'La Rioja']);
        Provincia::firstOrCreate(['codigo' => "AR50000", 'nombre' => 'Mendoza']);
        Provincia::firstOrCreate(['codigo' => "AR54000", 'nombre' => 'Misiones']);
        Provincia::firstOrCreate(['codigo' => "AR58000", 'nombre' => 'Neuquén']);
        Provincia::firstOrCreate(['codigo' => "AR62000", 'nombre' => 'Río Negro']);
        Provincia::firstOrCreate(['codigo' => "AR66000", 'nombre' => 'Salta']);
        Provincia::firstOrCreate(['codigo' => "AR70000", 'nombre' => 'San Juan']);
        Provincia::firstOrCreate(['codigo' => "AR74000", 'nombre' => 'San Luis']);
        Provincia::firstOrCreate(['codigo' => "AR78000", 'nombre' => 'Santa Cruz']);
        Provincia::firstOrCreate(['codigo' => "AR82000", 'nombre' => 'Santa Fe']);
        Provincia::firstOrCreate(['codigo' => "AR86000", 'nombre' => 'Santiago del Estero']);
        Provincia::firstOrCreate(['codigo' => "AR94000", 'nombre' => 'Tierra del Fuego, Antártida e Isla del Atlántico Sur']);
        Provincia::firstOrCreate(['codigo' => "AR90000", 'nombre' => 'Tucumán']);
    }
}
