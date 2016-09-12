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

class PublicoController extends Controller
{
	public function publicaciones()
	{
		$data['categorias'] = Categoria::all();
		return view('frontend.publicaciones', $data);
	}

    public function variables()
	{
		$data['variables'] = Variable::all();
		$data['paises'] = Pais::all();
		$data['provincias'] = Provincia::all();
		$data['municipios'] = Municipio::all();
		$data['semestres'] = Frecuencia::where('tipo', '=', 'SEMESTRE')->get();
		$data['trimestres'] = Frecuencia::where('tipo', '=', 'TRIMESTRE')->get();
		$data['meses'] = Frecuencia::where('tipo', '=', 'MES')->get();
		$data['periodos'] = array_unique(InformacionVariable::lists('anio')->toArray());
		return view('frontend.variables', $data);
	}

	public function resultados_variables(Request $request)
	{
		$input = $request->all();
		//return var_dump($input);
		$variables = $input['variable'];
		$zonas = $input[$input['tipo_zona']];
		$periodos = $input['periodo'];
		$frecuencia = ($input['tipo_frecuencia'] == 'anual') ? array(Frecuencia::where('tipo', '=', 'ANIO')->first()->id) : $input[$input['tipo_frecuencia']];
		
		$datos['resultados'] = InformacionVariable::whereIn('variable_id', $variables)
								->whereIn('zona_id', $zonas)
								->whereIn('anio', $periodos)
								->whereIn('frecuencia_id', $frecuencia)
								->orderBy('variable_id', 'ASC')->orderBy('zona_id', 'ASC')->orderBy('anio', 'ASC')->orderBy('frecuencia_id', 'ASC')->get();
		//$datos['resultados'] =  InformacionVariable::all();
								
		return view('frontend.resultados_variables', $datos);
	}
	public function indicadores()
	{
		return view('frontend.indicadores');
	}
}
