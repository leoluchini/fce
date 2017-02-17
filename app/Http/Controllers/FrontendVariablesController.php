<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Variable;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Frecuencia;
use App\Models\InformacionVariable;
use App\Models\ZonaGeografica;
use App\Models\VariableSinResultados;
use App\Models\Tema;
use App\Models\CategoriaVariable;
use App\Models\Lote;
use Illuminate\Support\Facades\DB;

class FrontendVariablesController extends Controller
{
    public function variables(Request $request)
	{
		$data['paises'] = Pais::all();
		$data['provincias'] = Provincia::all();
		$data['municipios'] = Municipio::all();
		$data['semestres'] = Frecuencia::where('tipo', '=', 'SEMESTRE')->get();
		$data['trimestres'] = Frecuencia::where('tipo', '=', 'TRIMESTRE')->get();
		$data['meses'] = Frecuencia::where('tipo', '=', 'MES')->get();
		$info_anios = DB::select('SELECT distinct anio 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									ORDER BY anio ASC');
		$data['periodos'] = convert_object_array($info_anios, 'anio');

		$temas_variables = Variable::select('variables.tema_id')
									->join('lotes', 'variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
									->distinct()->whereNotNull('tema_id')->get()->lists('tema_id')->toArray();
		$data['temas'] = Tema::whereIn('temas.id', $temas_variables)->get();
		$data['categorias'] = CategoriaVariable::select('categorias_variables.*')
												->join('lotes', 'categorias_variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
												->whereNull('categoria_padre_id')->get();
		$data['variables_sin_tema'] = Variable::select('variables.*')
												->join('lotes', 'variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
												->whereNull('tema_id')->get();

		if($request->isMethod('post')){
			$data['consulta'] = $request->all();
			$data['consulta']['variable_name'] = Variable::whereIn('variables.id', $data['consulta']['variable_id'])->get()->lists('nombre', 'id');
		}
		return view('frontend.variables.variables', $data);
	}

	public function resultados_variables(Request $request)
	{
		$input = $request->all();
		$variables = $input['variable_id'];
		$zonas = $input[$input['tipo_zona']];
		$periodos = $input['periodo'];
		$frecuencia = ($input['tipo_frecuencia'] == 'anual') ? array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id) : $input[$input['tipo_frecuencia']];
		
		$datos['resultados'] = InformacionVariable::select('informacion_variables.*')
								->join('lotes', 'informacion_variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
								->whereIn('variable_id', $variables)
								->whereIn('zona_id', $zonas)
								->whereIn('anio', $periodos)
								->whereIn('frecuencia_id', $frecuencia)
								->orderBy('variable_id', 'ASC')->orderBy('zona_id', 'ASC')->orderBy('anio', 'ASC')->orderBy('frecuencia_id', 'ASC')->get();
								
		$datos['busqueda'] = array('Variables' => Variable::find($variables)->lists('nombre')->toArray(),
								   'Regiones' => ZonaGeografica::find($zonas)->lists('nombre')->toArray(),
								   'Periodos' => $periodos,
								   'Frecuencias' => Frecuencia::find($frecuencia)->lists('nombre')->toArray());
		$info_var = array('variables' => array(), 'unidades' => array(), 'fuentes' => array(), 'regiones' => array(), 'aniofrec' => array());
		$data_var = array();
		$data_var_inversa = array();
		$data_reg = array();
		$data_reg_inversa = array();
		$data_frec = array();
		$data_frec_inversa = array();
		foreach($datos['resultados'] as $res)
		{
			if(!isset($info_var['variables'][$res->variable->id])){
				$info_var['variables'][$res->variable->id] = $res->variable->nombre;
			}
			if(!isset($info_var['unidades'][$res->variable->id])){
				$info_var['unidades'][$res->variable->id] = $res->unidad_medida->nombre;
			}
			if(!isset($info_var['fuentes'][$res->variable->id])){
				$info_var['fuentes'][$res->variable->id] = $res->fuente->nombre;
			}
			if(!isset($info_var['regiones'][$res->zona->id])){
				$info_var['regiones'][$res->zona->id] = $res->zona->fullName();
			}
			$anio_frecuencia = $res->anio.'-'.$res->frecuencia->id;
			if(!isset($info_var['aniofrec'][$anio_frecuencia])){
				$info_var['aniofrec'][$anio_frecuencia] = ($res->frecuencia->tipo == 'ANIO') ? $res->anio : $res->anio.' '.$res->frecuencia->nombre;
			}
			$data_var[$res->variable->id][$res->zona->id][$anio_frecuencia] = $res->valor;
			$data_var_inversa[$res->variable->id][$anio_frecuencia][$res->zona->id] = $res->valor;

			$data_reg[$res->zona->id][$res->variable->id][$anio_frecuencia] = $res->valor;
			$data_reg_inversa[$res->zona->id][$anio_frecuencia][$res->variable->id] = $res->valor;

			$data_frec[$anio_frecuencia][$res->zona->id][$res->variable->id] = $res->valor;
			$data_frec_inversa[$anio_frecuencia][$res->variable->id][$res->zona->id] = $res->valor;
		}

		/*$info_adicional = array();
		foreach($info_var['variables'] as $k => $v)
		{
			$prom_frecuencia = array();
			$prom_region = array();
			$min = null;
			$max = null;
			foreach($data_var[$k] as $key => $value)
			{
				$prom_frecuencia[] = array_sum($value) / count($info_var['aniofrec']);
				$actual_min = min($value);
				$actual_max = max($value);
				$min = ($min == null) ? $actual_min : (($actual_min < $min) ? $actual_min : $min);
				$max = ($max == null) ? $actual_max : (($actual_max > $max) ? $actual_max : $max);
			}
			foreach($data_var_inversa[$k] as $key => $value)
			{
				$prom_region[] = array_sum($value) / count($info_var['regiones']);
			}
			$info_adicional[$k] = array('minimo' => $min, 'maximo' => $max, 'promedio_frecuencia' => $prom_frecuencia, 'promedio_regional' => $prom_region);
		}*/
		$info_adicional = $this->get_info_adicional($info_var['variables'], $data_var, $data_var_inversa, 'promedio_frecuencia', count($info_var['aniofrec']), 'promedio_regional', count($info_var['regiones']));
		$info_adicional_regiones = $this->get_info_adicional($info_var['regiones'], $data_reg, $data_reg_inversa, 'promedio_frecuencia', count($info_var['aniofrec']), 'promedio_variable', count($info_var['variables']));
		$info_adicional_frecuencias = $this->get_info_adicional($info_var['aniofrec'], $data_frec, $data_frec_inversa, 'promedio_regional', count($info_var['regiones']), 'promedio_variable', count($info_var['variables']));


		$datos['info_pivot'] = $info_var;
		$datos['data_pivot'] = $data_var;
		$datos['data_pivot_inversa'] = $data_var_inversa;
		$datos['datos_adicionales'] = $info_adicional;
		$datos['datos_adicionales_region'] = $info_adicional_regiones;
		$datos['datos_adicionales_frecuencia'] = $info_adicional_frecuencias;
		$datos['filtros'] = $input;
		return view('frontend.variables.resultados_variables', $datos);
	}

	private function get_info_adicional($index, $datos, $datos_inv, $prom1_label, $prom1_total, $prom2_label, $prom2_total)
	{
		$info_adicional = array();
		foreach($index as $k => $v)
		{
			$prom_1 = array();
			$prom_2 = array();
			$min = null;
			$max = null;
			foreach($datos[$k] as $key => $value)
			{
				$prom_1[] = array_sum($value) / $prom1_total;
				$actual_min = min($value);
				$actual_max = max($value);
				$min = ($min == null) ? $actual_min : (($actual_min < $min) ? $actual_min : $min);
				$max = ($max == null) ? $actual_max : (($actual_max > $max) ? $actual_max : $max);
			}
			foreach($datos_inv[$k] as $key => $value)
			{
				$prom_2[] = array_sum($value) / $prom2_total;
			}
			$info_adicional[$k] = array('minimo' => $min, 'maximo' => $max, $prom1_label => $prom_1, $prom2_label => $prom_2);
		}
		return $info_adicional;
	}

	public function consulta_variables(Request $request)
	{
		$input = $request->all();
		$query = "'%".str_replace(' ', '%', $input['busqueda'])."%'";
		//$string_consulta = "replace(replace(replace(replace(replace(LOWER(\"variables\".\"nombre\"), 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u') like ".$query;
		$string_consulta = "nombre ilike ".$query;
		if(($input['tipo_busqueda'] == 'region_variable') && isset($input['regiones']))
		{
			/*$res = Variable::select('variables.*')
				->join('lotes', 'variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
				->whereRaw($string_consulta)
				->join('informacion_variables', 'variables.id', '=', 'informacion_variables.variable_id')
				->whereIn('informacion_variables.zona_id', $input['regiones'])
				->distinct()
				->get();*/
			$listado_regiones = '('.implode(',', $input['regiones']).')';
			$res = Variable::whereRaw('variables.id in (SELECT distinct variable_id 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_variables.zona_id in '.$listado_regiones.')')
							->whereRaw($string_consulta)
							->get();
		}
		else{
			$res = Variable::select('variables.*')
					->join('lotes', 'variables.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
					->whereRaw($string_consulta)
					->get();
		}
		if(count($res->toArray()) == 0){
			VariableSinResultados::firstOrCreate($input['busqueda']);
		}
		$resultados = array();
		foreach($res as $variable){
			$resultados[] = array('clave' => $variable->id, 'valor' => $variable->nombre, 'relacionados' => ($variable->tema ? true : false));
		}

		return response()->json($resultados);
	}
	public function consulta_regiones($variables)
	{
		$listado_variables = '('.str_replace('-', ',', $variables).')';
		//TESTEAR SI ES MAS RAPIDA ESTA CONSULTA
		/*$resultados = DB::select('SELECT distinct zona_id 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_variables.variable_id in '.$listado_variables);
		$listado_zonas = convert_object_array($resultados, 'zona_id');
		$res = ZonaGeografica::whereIn('zonas_geograficas.id', $listado_zonas)->get();*/

		$res = ZonaGeografica::whereRaw('zonas_geograficas.id in (SELECT distinct zona_id 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_variables.variable_id in '.$listado_variables.')')
									->orderBy('tipo', 'ASC')->orderBy('zona_padre_id', 'ASC')->orderBy('nombre', 'ASC')->get();

		$paises = $provincias = $municipios = array();
		foreach($res as $zona)
		{
			switch ($zona->tipo) {
				case 'pais':
					$paises[] = ['id' => $zona->id, 'nombre' => $zona->fullName()];
					break;
				case 'provincia':
					$provincias[] = ['id' => $zona->id, 'nombre' => $zona->fullName()];
					break;
				case 'municipio':
					$municipios[] = ['id' => $zona->id, 'nombre' => $zona->fullName()];
					break;
			}
		}
		return response()->json(['paises' => $paises, 'provincias' => $provincias, 'municipios' => $municipios]);
	}

	public function consulta_periodos(Request $request)
	{
		$input = $request->all();

		$listado_regiones = '('.implode(',', $input['regiones']).')';
		$listado_variables = '('.implode(',', $input['variables']).')';
		$resultados = DB::select('SELECT distinct anio 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_variables.zona_id in '.$listado_regiones.' 
									AND informacion_variables.variable_id in '.$listado_variables.' 
									ORDER BY anio ASC');
		$periodos = convert_object_array($resultados, 'anio');
		
		return response()->json($periodos);
	}
	public function consulta_frecuencias(Request $request)
	{
		$input = $request->all();

		$listado_regiones = '('.implode(',', $input['regiones']).')';
		$listado_variables = '('.implode(',', $input['variables']).')';
		$listado_anios = '('.implode(',', $input['periodos']).')';
		$resultados = DB::select('SELECT distinct frecuencia_id 
									FROM informacion_variables join lotes on informacion_variables.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_variables.zona_id in '.$listado_regiones.' 
									AND informacion_variables.variable_id in '.$listado_variables.' 
									AND informacion_variables.anio in '.$listado_anios);
		$frecuencias = convert_object_array($resultados, 'frecuencia_id');
		
		return response()->json(array('frecuencias' => $frecuencias));
	}

	public function descarga_variables_excel(Request $request)
	{
		$input = $request->all();
		$variables = $input['variable_id'];
		$zonas = $input['regiones'];
		$periodos = $input['periodo'];
		$frecuencia = isset($input['frecuencias']) ? $input['frecuencias'] : array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id);
		
		$resultados = InformacionVariable::whereIn('variable_id', $variables)
								->whereIn('zona_id', $zonas)
								->whereIn('anio', $periodos)
								->whereIn('frecuencia_id', $frecuencia)
								->orderBy('variable_id', 'ASC')->orderBy('zona_id', 'ASC')->orderBy('anio', 'ASC')->orderBy('frecuencia_id', 'ASC')->get();

		$columna_region = ($input['tipo_zona'] == 'municipio') ? 'Municipio/Departamento' : ucfirst($input['tipo_zona']);
		\Excel::create('Variables', function($excel) use ($resultados, $columna_region)
		{
		    $excel->sheet('Hoja Excel de Variables', function($sheet) use ($resultados, $columna_region)
		    {		
			    // tamaño de las celdas automatico
			 	$sheet->setAutoSize(true);
		    	// titulos en negrita
			    $sheet->cells('A1:F1', function($cells){$cells->setFontWeight('bold');});
			    $sheet->mergeCells("A1:F1");
			    $sheet->cells('A2:F2', function($cells){$cells->setFontWeight('bold');});
			    $sheet->cells('A:F', function($cells){$cells->setAlignment('left');});

			    $data=[];
			    array_push($data, array('Fecha de descarga: '.date('d/m/Y'), '', '','','',''));
			    array_push($data, array('Variable', $columna_region, 'Año/Periodo','Valor','Unidad de medida','Fuente'));
			    foreach($resultados as $resultado)
			    {
			    	$periodo = ($resultado->frecuencia->tipo != 'ANIO') ? $resultado->anio .' / '.  $resultado->frecuencia->nombre : $resultado->anio;
		    		array_push($data, array($resultado->variable->nombre, 
		    								$resultado->zona->nombre, 
		    								$periodo, 
		    								number_format($resultado->valor, 2, ',', '.'), 
		    								$resultado->unidad_medida->nombre, 
		    								$resultado->fuente->nombre
		    								));
			    }

			    $sheet->fromArray($data, null, 'A1', false, false);
		    });

		})->export('xlsx');

	}
	
}
