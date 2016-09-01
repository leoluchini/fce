<?php

use Illuminate\Database\Seeder;
use App\Models\Frecuencia;
class FrecuenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frecuencia::create(['codigo' => "ANIO", 'tipo' => "ANIO", 'nombre' => "Año"]);
		Frecuencia::create(['codigo' => "S1", 'tipo' => "SEMESTRE", 'nombre' => "Primer semestre"]);
		Frecuencia::create(['codigo' => "S2", 'tipo' => "SEMESTRE", 'nombre' => "Segundo semestre"]);
		Frecuencia::create(['codigo' => "T1", 'tipo' => "TRIMESTRE", 'nombre' => "Primer trimestre"]);
		Frecuencia::create(['codigo' => "T2", 'tipo' => "TRIMESTRE", 'nombre' => "Segundo trimestre"]);
		Frecuencia::create(['codigo' => "T3", 'tipo' => "TRIMESTRE", 'nombre' => "Tercer trimestre"]);
		Frecuencia::create(['codigo' => "T4", 'tipo' => "TRIMESTRE", 'nombre' => "Cuarto trimestre"]);
		Frecuencia::create(['codigo' => "M1", 'tipo'=> "MES", 'nombre' => "Enero"]);
		Frecuencia::create(['codigo' => "M2", 'tipo'=> "MES", 'nombre' => "Febrero"]);
		Frecuencia::create(['codigo' => "M3", 'tipo'=> "MES", 'nombre' => "Marzo"]);
		Frecuencia::create(['codigo' => "M4", 'tipo'=> "MES", 'nombre' => "Abril"]);
		Frecuencia::create(['codigo' => "M5", 'tipo'=> "MES", 'nombre' => "Mayo"]);
		Frecuencia::create(['codigo' => "M6", 'tipo'=> "MES", 'nombre' => "Junio"]);
		Frecuencia::create(['codigo' => "M7", 'tipo'=> "MES", 'nombre' => "Julio"]);
		Frecuencia::create(['codigo' => "M8", 'tipo'=> "MES", 'nombre' => "Agosto"]);
		Frecuencia::create(['codigo' => "M9", 'tipo'=> "MES", 'nombre' => "Septiembre"]);
		Frecuencia::create(['codigo' => "M10", 'tipo'=> "MES", 'nombre' => "Octubre"]);
		Frecuencia::create(['codigo' => "M11", 'tipo'=> "MES", 'nombre' => "Noviembre"]);
		Frecuencia::create(['codigo' => "M12", 'tipo'=> "MES", 'nombre' => "Diciembre"]);
    }
}
