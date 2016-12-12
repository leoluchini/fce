<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CategoriaIndicador;
use App\Models\Indicador;
use App\Models\Tema;
use App\Models\IndicadorSinResultados;
use App\Http\Requests\IndicadorRequest;

class IndicadorController extends Controller
{
	public function index($categoria_id)
	{
		$data['categoria'] = CategoriaIndicador::findOrFail($categoria_id);
		$data['indicadores'] = Indicador::where('categoria_id', $categoria_id)->orderBy('id')->paginate(25);
		return view('indicadores.index', $data);
	}
	public function create($categoria_id)
	{
		try
		{
			$data['categoria'] = CategoriaIndicador::findOrFail($categoria_id);
			$data['indicador'] = new Indicador;
			return view('indicadores.create', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_indicadores');
		}
	}

	public function store($categoria_id, IndicadorRequest $request)
	{
		try
		{
			$categoria = CategoriaIndicador::findOrFail($categoria_id);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_indicadores');
		}
		$input = $request->all();
		$indicador = Indicador::create($input);

		\Session::flash('noticia', 'Se creo el indicador "'.$indicador->nombre.'" correctamente en la categoria "'.$categoria->nombre.'"');
		return redirect('administracion/categorias_indicadores');
	}

	public function edit($categoria_id, $id)
	{
		try
		{
			$data['indicador'] = Indicador::findOrFail($id);
			$data['categoria'] = CategoriaIndicador::findOrFail($categoria_id);
			return view('indicadores.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'El indicador no existe.');
			return redirect('administracion/categoria/'.$categoria_id.'/indicadores');
		}
	}

	public function update($categoria_id, $id, IndicadorRequest $request)
	{
		try
		{
			$indicador = Indicador::findOrFail($id);
			$input = $request->all();
			
			$indicador->update($input);

			\Session::flash('noticia', 'El indicador "'.$indicador->nombre.'" fue actualizado con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'El indicador no existe.');
		}
		return redirect('administracion/categoria/'.$categoria_id.'/indicadores');
	}

	public function destroy($categoria_id, $id)
	{
		try
		{
			$indicador = Indicador::findOrFail($id);
			$indicador->delete();
			\Session::flash('noticia', 'El indicador "'.$indicador->nombre.'" fue eliminado con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'El indicador no existe.');
		}
		
		return redirect('administracion/categoria/'.$categoria_id.'/indicadores');
	}

	public function temas()
	{
		$temas_indicadores = Indicador::select('indicadores.tema_id')->distinct()->whereNotNull('tema_id')->get()->lists('tema_id')->toArray();
		$data['temas'] = Tema::whereIn('temas.id', $temas_indicadores)->get();
		$data['indicadores'] = Indicador::whereNull('tema_id')->get();
		return view('indicadores.temas', $data);
	}
	public function busquedas()
	{
		$data['busquedas'] = IndicadorSinResultados::paginate(25);
		return view('indicadores.busquedas', $data);
	}
}
