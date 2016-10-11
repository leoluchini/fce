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
use App\Models\VariableSinResultados;
use App\Models\Tema;
use App\Models\CategoriaVariable;

class PublicoController extends Controller
{
	public function publicaciones(Request $request)
	{
		$data['categorias'] = Categoria::all();
		$data['anios'] = get_anios(['' => 'Todos']);
		//$data['filtros']['busqueda'] = '/^(?=.*fi)(?=.*uno).*$/';
		if($request->isMethod('post')){
			$data['filtros'] = $request->all();
			if(isset($data['filtros']['busqueda'])){
				$data['filtros']['regex'] = '/^';
				$palabras = explode(' ', $data['filtros']['busqueda']);
				foreach($palabras as $palabra){
					$data['filtros']['regex'] .= '(?=.*'.$palabra.')';
				}
				$data['filtros']['regex'] .= '.*$/';
			}
		}
		return view('frontend.publicaciones', $data);
	}

    public function variables(Request $request)
	{
		$data['paises'] = Pais::all();
		$data['provincias'] = Provincia::all();
		$data['municipios'] = Municipio::all();
		$data['semestres'] = Frecuencia::where('tipo', '=', 'SEMESTRE')->get();
		$data['trimestres'] = Frecuencia::where('tipo', '=', 'TRIMESTRE')->get();
		$data['meses'] = Frecuencia::where('tipo', '=', 'MES')->get();
		$data['periodos'] = array_unique(InformacionVariable::lists('anio')->toArray());

		$data['temas'] = Tema::all();
		$data['categorias'] = CategoriaVariable::whereNull('categoria_padre_id')->get();
		$data['variables_sin_tema'] = Variable::whereNull('tema_id')->get();


		if($request->isMethod('post')){
			$data['consulta'] = $request->all();
			$data['consulta']['variable_name'] = Variable::whereIn('variables.id', $data['consulta']['variable_id'])->get()->lists('nombre', 'id');
		}
		return view('frontend.variables.variables', $data);
	}

	public function consulta_variables(Request $request)
	{
		$input = $request->all();
		$query = "'%".str_replace(' ', '%', $input['busqueda'])."%'";
		//$string_consulta = "replace(replace(replace(replace(replace(LOWER(\"variables\".\"nombre\"), 'á', 'a'), 'é', 'e'), 'í', 'i'), 'ó', 'o'), 'ú', 'u') like ".$query;
		$string_consulta = "nombre like ".$query;
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
		if(count($res->toArray()) == 0){
			VariableSinResultados::firstOrCreate($input['busqueda']);
		}
		$temporal = $res->lists('nombre', 'id')->toArray();
		$ids = array();
		$resultados = array();
		foreach($temporal as $key => $temp){
			$ids[] = $key;
			$resultados[] = array('clave' => $key, 'valor' => $temp);
		}
		foreach($res as $variable){
			if($variable->tema){
				foreach($variable->tema->variables as $var_asociada){
					if(!in_array($var_asociada->id, $ids)){
						$resultados[] = array('clave' => $var_asociada->id, 'valor' => $var_asociada->nombre.' (asociada por tema)');
					}
				}
			}
		}

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
					$provincias[] = ['id' => $zona->id, 'nombre' => $zona->nombre.' ('.$zona->pais->nombre.')'];
					break;
				case 'municipio':
					$municipios[] = ['id' => $zona->id, 'nombre' => $zona->nombre.' ('.$zona->provincia->nombre.', '.$zona->provincia->pais->nombre.')'];
					break;
			}
		}
		return response()->json(['paises' => $paises, 'provincias' => $provincias, 'municipios' => $municipios]);
	}

	public function resultados_variables(Request $request)
	{
		$input = $request->all();
		$variables = $input['variable_id'];
		$zonas = $input[$input['tipo_zona']];
		$periodos = $input['periodo'];
		$frecuencia = ($input['tipo_frecuencia'] == 'anual') ? array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id) : $input[$input['tipo_frecuencia']];
		
		$datos['resultados'] = InformacionVariable::whereIn('variable_id', $variables)
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
				$info_var['regiones'][$res->zona->id] = $res->zona->nombre;
			}
			$anio_frecuencia = $res->anio.'-'.$res->frecuencia->id;
			if(!isset($info_var['aniofrec'][$anio_frecuencia])){
				$info_var['aniofrec'][$anio_frecuencia] = ($res->frecuencia->tipo == 'ANIO') ? $res->anio : $res->anio.' '.$res->frecuencia->nombre;
			}
			$data_var[$res->variable->id][$res->zona->id][$anio_frecuencia] = $res->valor;
			$data_var_inversa[$res->variable->id][$anio_frecuencia][$res->zona->id] = $res->valor;
		}

		$info_adicional = array();
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
		}


		$datos['info_pivot'] = $info_var;
		$datos['data_pivot'] = $data_var;
		$datos['data_pivot_inversa'] = $data_var_inversa;
		$datos['datos_adicionales'] = $info_adicional;
		$datos['filtros'] = $input;
		return view('frontend.variables.resultados_variables', $datos);
	}
	public function consulta_periodos(Request $request)
	{
		$input = $request->all();

		$resultados = InformacionVariable::whereIn('informacion_variables.zona_id', $input['regiones'])
										 ->whereIn('informacion_variables.variable_id', $input['variables'])
										 ->get();
		$periodos = array_values(array_unique($resultados->lists('anio')->toArray()));
		
		return response()->json($periodos);
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

	public function indicadores()
	{
		return view('frontend.indicadores');
	}
}
