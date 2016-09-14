<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Categoria;
use App\Models\Variable;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Frecuencia;
use App\Models\InformacionVariable;
use App\Models\ZonaGeografica;

class PublicoController extends Controller
{
	public function publicaciones()
	{
		$data['categorias'] = Categoria::all();
		return view('frontend.publicaciones', $data);
	}

    public function variables()
	{
		$data['paises'] = Pais::all();
		$data['provincias'] = Provincia::all();
		$data['municipios'] = Municipio::all();
		$data['semestres'] = Frecuencia::where('tipo', '=', 'SEMESTRE')->get();
		$data['trimestres'] = Frecuencia::where('tipo', '=', 'TRIMESTRE')->get();
		$data['meses'] = Frecuencia::where('tipo', '=', 'MES')->get();
		$data['periodos'] = array_unique(InformacionVariable::lists('anio')->toArray());
		return view('frontend.variables', $data);
	}

	public function consulta_variables(Request $request)
	{
		$input = $request->all();
		$query = "'%".str_replace(' ', '%', $input['busqueda'])."%'";
		$string_consulta = "replace(replace(replace(replace(replace(LOWER(\"variables\".\"nombre\"), 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u') like ".$query;
		if(($input['tipo_busqueda'] == 'region_variable')&&(count($input['regiones'] > 0)))
		{
			$res = Variable::select('variables.*')
				->whereRaw($string_consulta)
				->join('informacion_variables', 'variables.id', '=', 'informacion_variables.variable_id')
				->whereIn('informacion_variables.zona_id', $input['regiones'])
				->distinct()
				->get();
		}
		else{
			$res = Variable::whereRaw($string_consulta)->get();
		}
		$resultados = $res->lists('nombre', 'id')->toArray();
		return response()->json($resultados);
	}
	public function consulta_regiones($variables)
	{
		$lista_variables = explode('-', $variables);

		$res = ZonaGeografica::select('zonas_geograficas.*')
			->join('informacion_variables', 'zonas_geograficas.id', '=', 'informacion_variables.zona_id')
			->whereIn('informacion_variables.variable_id', $lista_variables)
			->distinct()
			->get();
		$paises = $provincias = $municipios = array();
		foreach($res as $zona)
		{
			switch ($zona->tipo) {
				case 'pais':
					$paises[] = ['id' => $zona->id, 'nombre' => $zona->nombre];
					break;
				case 'provincia':
					$provincias[] = ['id' => $zona->id, 'nombre' => $zona->nombre];
					break;
				case 'municipio':
					$municipios[] = ['id' => $zona->id, 'nombre' => $zona->nombre];
					break;
			}
		}
		return response()->json(['paises' => $paises, 'provincias' => $provincias, 'municipios' => $municipios]);
	}

	public function resultados_variables(Request $request)
	{
		$input = $request->all();
		$variables = $input['variable'];
		$zonas = $input[$input['tipo_zona']];
		$periodos = $input['periodo'];
		$frecuencia = ($input['tipo_frecuencia'] == 'anual') ? array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id) : $input[$input['tipo_frecuencia']];
		
		$datos['resultados'] = InformacionVariable::whereIn('variable_id', $variables)
								->whereIn('zona_id', $zonas)
								->whereIn('anio', $periodos)
								->whereIn('frecuencia_id', $frecuencia)
								->orderBy('variable_id', 'ASC')->orderBy('zona_id', 'ASC')->orderBy('anio', 'ASC')->orderBy('frecuencia_id', 'ASC')->get();
								
		return view('frontend.resultados_variables', $datos);
	}

	public function indicadores()
	{
		return view('frontend.indicadores');
	}
}
