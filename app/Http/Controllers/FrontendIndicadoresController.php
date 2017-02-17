<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Indicador;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Frecuencia;
use App\Models\InformacionIndicador;
use App\Models\ZonaGeografica;
use App\Models\IndicadorSinResultados;
use App\Models\Tema;
use App\Models\CategoriaIndicador;
use App\Models\Lote;
use Illuminate\Support\Facades\DB;

class FrontendIndicadoresController extends Controller
{
    public function indicadores(Request $request)
	{
		$data['paises'] = Pais::all();
		$data['provincias'] = Provincia::all();
		$data['municipios'] = Municipio::all();
		$data['semestres'] = Frecuencia::where('tipo', '=', 'SEMESTRE')->get();
		$data['trimestres'] = Frecuencia::where('tipo', '=', 'TRIMESTRE')->get();
		$data['meses'] = Frecuencia::where('tipo', '=', 'MES')->get();
		$info_anios = DB::select('SELECT distinct anio 
									FROM informacion_indicadores join lotes on informacion_indicadores.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									ORDER BY anio ASC');
		$data['periodos'] = convert_object_array($info_anios, 'anio');

		$temas_indicadores = Indicador::select('indicadores.tema_id')
										->join('lotes', 'indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
										->distinct()->whereNotNull('tema_id')->get()->lists('tema_id')->toArray();
		$data['temas'] = Tema::whereIn('temas.id', $temas_indicadores)->get();
		$data['categorias'] = CategoriaIndicador::select('categorias_indicadores.*')
												->join('lotes', 'categorias_indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
												->whereNull('categoria_padre_id')->get();
		$data['indicadores_sin_tema'] = Indicador::select('indicadores.*')
													->join('lotes', 'indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
													->whereNull('tema_id')->get();


		if($request->isMethod('post')){
			$data['consulta'] = $request->all();
			$data['consulta']['indicador_name'] = Indicador::whereIn('indicadores.id', $data['consulta']['indicador_id'])->get()->lists('nombre', 'id');
		}
		return view('frontend.indicadores.indicadores', $data);
	}

	public function resultados_indicadores(Request $request)
	{
		$input = $request->all();
		$indicadores = $input['indicador_id'];
		$zonas = $input[$input['tipo_zona']];
		$periodos = $input['periodo'];
		$frecuencia = ($input['tipo_frecuencia'] == 'anual') ? array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id) : $input[$input['tipo_frecuencia']];
		
		$datos['resultados'] = InformacionIndicador::select('informacion_indicadores.*')
								->join('lotes', 'informacion_indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
								->whereIn('indicador_id', $indicadores)
								->whereIn('zona_id', $zonas)
								->whereIn('anio', $periodos)
								->whereIn('frecuencia_id', $frecuencia)
								->orderBy('indicador_id', 'ASC')->orderBy('zona_id', 'ASC')->orderBy('anio', 'ASC')->orderBy('frecuencia_id', 'ASC')->get();
								
		$datos['busqueda'] = array('Indicadores' => Indicador::find($indicadores)->lists('nombre')->toArray(),
								   'Regiones' => ZonaGeografica::find($zonas)->lists('nombre')->toArray(),
								   'Periodos' => $periodos,
								   'Frecuencias' => Frecuencia::find($frecuencia)->lists('nombre')->toArray());
		$info_ind = array('indicador' => array(), 'unidades' => array(), 'fuentes' => array(), 'regiones' => array(), 'aniofrec' => array());
		$data_ind = array();
		$data_ind_inversa = array();
		$data_reg = array();
		$data_reg_inversa = array();
		$data_frec = array();
		$data_frec_inversa = array();
		foreach($datos['resultados'] as $res)
		{
			if(!isset($info_ind['indicadores'][$res->indicador->id])){
				$info_ind['indicadores'][$res->indicador->id] = $res->indicador->nombre;
			}
			if(!isset($info_ind['unidades'][$res->indicador->id])){
				$info_ind['unidades'][$res->indicador->id] = $res->unidad_medida->nombre;
			}
			if(!isset($info_ind['fuentes'][$res->indicador->id])){
				$info_ind['fuentes'][$res->indicador->id] = $res->fuente->nombre;
			}
			if(!isset($info_ind['regiones'][$res->zona->id])){
				$info_ind['regiones'][$res->zona->id] = $res->zona->fullName();
			}
			$anio_frecuencia = $res->anio.'-'.$res->frecuencia->id;
			if(!isset($info_ind['aniofrec'][$anio_frecuencia])){
				$info_ind['aniofrec'][$anio_frecuencia] = ($res->frecuencia->tipo == 'ANIO') ? $res->anio : $res->anio.' '.$res->frecuencia->nombre;
			}
			$data_ind[$res->indicador->id][$res->zona->id][$anio_frecuencia] = $res->valor;
			$data_ind_inversa[$res->indicador->id][$anio_frecuencia][$res->zona->id] = $res->valor;

			$data_reg[$res->zona->id][$res->indicador->id][$anio_frecuencia] = $res->valor;
			$data_reg_inversa[$res->zona->id][$anio_frecuencia][$res->indicador->id] = $res->valor;

			$data_frec[$anio_frecuencia][$res->zona->id][$res->indicador->id] = $res->valor;
			$data_frec_inversa[$anio_frecuencia][$res->indicador->id][$res->zona->id] = $res->valor;
		}

		$info_adicional = $this->get_info_adicional($info_ind['indicadores'], $data_ind, $data_ind_inversa, 'promedio_frecuencia', count($info_ind['aniofrec']), 'promedio_regional', count($info_ind['regiones']));
		$info_adicional_regiones = $this->get_info_adicional($info_ind['regiones'], $data_reg, $data_reg_inversa, 'promedio_frecuencia', count($info_ind['aniofrec']), 'promedio_indicador', count($info_ind['indicadores']));
		$info_adicional_frecuencias = $this->get_info_adicional($info_ind['aniofrec'], $data_frec, $data_frec_inversa, 'promedio_regional', count($info_ind['regiones']), 'promedio_indicador', count($info_ind['indicadores']));


		$datos['info_pivot'] = $info_ind;
		$datos['data_pivot'] = $data_ind;
		$datos['data_pivot_inversa'] = $data_ind_inversa;
		$datos['datos_adicionales'] = $info_adicional;
		$datos['datos_adicionales_region'] = $info_adicional_regiones;
		$datos['datos_adicionales_frecuencia'] = $info_adicional_frecuencias;
		$datos['filtros'] = $input;
		return view('frontend.indicadores.resultados_indicadores', $datos);
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

	public function consulta_indicadores(Request $request)
	{
		$input = $request->all();
		$query = "'%".str_replace(' ', '%', $input['busqueda'])."%'";
		$string_consulta = "nombre ilike ".$query;
		if(($input['tipo_busqueda'] == 'region_indicador') && isset($input['regiones']))
		{
			/*$res = Indicador::select('indicadores.*')
				->join('lotes', 'indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
				->whereRaw($string_consulta)
				->join('informacion_indicadores', 'indicadores.id', '=', 'informacion_indicadores.indicador_id')
				->whereIn('informacion_indicadores.zona_id', $input['regiones'])
				->distinct()
				->get();*/
			$listado_regiones = '('.implode(',', $input['regiones']).')';
			$res = Indicador::whereRaw('indicadores.id in (SELECT distinct indicador_id 
									FROM informacion_indicadores join lotes on informacion_indicadores.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_indicadores.zona_id in '.$listado_regiones.')')
							->whereRaw($string_consulta)
							->get();
		}
		else{
			$res = Indicador::select('indicadores.*')
					->join('lotes', 'indicadores.lote_id', '=', 'lotes.id')->where('lotes.estado', Lote::ESTADO_ACEPTADO)
					->whereRaw($string_consulta)
					->get();
		}
		if(count($res->toArray()) == 0){
			IndicadorSinResultados::firstOrCreate($input['busqueda']);
		}
		$resultados = array();
		foreach($res as $indicador){
			$resultados[] = array('clave' => $indicador->id, 'valor' => $indicador->nombre, 'relacionados' => ($indicador->tema ? true : false));
		}

		return response()->json($resultados);
	}

	public function consulta_regiones($indicadores)
	{
		$listado_indicadores = '('.str_replace('-', ',', $indicadores).')';
		
		$res = ZonaGeografica::whereRaw('zonas_geograficas.id in (SELECT distinct zona_id 
									FROM informacion_indicadores join lotes on informacion_indicadores.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_indicadores.indicador_id in '.$listado_indicadores.')')
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
		$listado_indicadores = '('.implode(',', $input['indicadores']).')';
		$resultados = DB::select('SELECT distinct anio 
									FROM informacion_indicadores join lotes on informacion_indicadores.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_indicadores.zona_id in '.$listado_regiones.' 
									AND informacion_indicadores.indicador_id in '.$listado_indicadores.' 
									ORDER BY anio ASC');
		$periodos = convert_object_array($resultados, 'anio');
		
		return response()->json($periodos);
	}
	public function consulta_frecuencias(Request $request)
	{
		$input = $request->all();

		$listado_regiones = '('.implode(',', $input['regiones']).')';
		$listado_indicadores = '('.implode(',', $input['indicadores']).')';
		$listado_anios = '('.implode(',', $input['periodos']).')';
		$resultados = DB::select('SELECT distinct frecuencia_id 
									FROM informacion_indicadores join lotes on informacion_indicadores.lote_id = lotes.id 
									WHERE lotes.estado = '.Lote::ESTADO_ACEPTADO.' 
									AND informacion_indicadores.zona_id in '.$listado_regiones.' 
									AND informacion_indicadores.indicador_id in '.$listado_indicadores.' 
									AND informacion_indicadores.anio in '.$listado_anios);
		$frecuencias = convert_object_array($resultados, 'frecuencia_id');
		
		return response()->json(array('frecuencias' => $frecuencias));
	}

}
