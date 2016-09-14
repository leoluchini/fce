<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Frecuencia;
use App\Http\Requests\FrecuenciaRequest;

class FrecuenciaController extends Controller
{
    public function index()
	{
		$data['frecuencias'] = Frecuencia::all();
		return view('frecuencias.index', $data);
	}

	public function create()
	{
		$data['frecuencia'] = new Frecuencia;
		$data['tipos_frecuencias'] = array('anio' => 'Anual', 'semestre' => 'Semestral', 'trimestre' => 'Trimestral', 'mes' => 'Mensual');
		return view('frecuencias.create', $data);
	}

	public function store(FrecuenciaRequest $request)
	{
		$input = $request->all();
		$frecuencia = Frecuencia::create($input);

		\Session::flash('noticia', 'La frecuencia "'.$frecuencia->nombre.'" fue creada con exito.');
		return redirect('administracion/frecuencias');
	}

	public function edit($id)
	{
		try
		{
			$data['frecuencia'] = Frecuencia::findOrFail($id);
			$data['tipos_frecuencias'] = array('anio' => 'Anual', 'semestre' => 'Semestral', 'trimestre' => 'Trimestral', 'mes' => 'Mensual');
			return view('frecuencias.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La frecuencia no existe.');
			return redirect('administracion/frecuencias');
		}
	}

	public function update($id, FrecuenciaRequest $request)
	{
		try
		{
			$frecuencia = Frecuencia::findOrFail($id);
			$input = $request->all();
			
			$frecuencia->update($input);

			\Session::flash('noticia', 'La frecuencia "'.$frecuencia->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La frecuencia no existe.');
		}
		return redirect('administracion/frecuencias');
	}

	public function destroy($id)
	{
		try
		{
			$frecuencia = Frecuencia::findOrFail($id);
			$frecuencia->delete();
			\Session::flash('noticia', 'La frecuencia "'.$frecuencia->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La frecuencia no existe.');
		}
		return redirect('administracion/frecuencias');
	}
}
