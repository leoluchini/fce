<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UnidadMedida;
use App\Http\Requests\UnidadRequest;

class UnidadController extends Controller
{
    public function index()
	{
		$data['unidades'] = UnidadMedida::all();
		return view('unidades.index', $data);
	}

	public function create()
	{
		$data['unidad'] = new UnidadMedida;
		return view('unidades.create', $data);
	}

	public function store(UnidadRequest $request)
	{
		$input = $request->all();
		$unidad = UnidadMedida::create($input);

		\Session::flash('noticia', 'La unidad de medida "'.$unidad->nombre.'" fue creada con exito.');
		return redirect('administracion/unidades');
	}

	public function edit($id)
	{
		try
		{
			$data['unidad'] = UnidadMedida::findOrFail($id);
			return view('unidades.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La unidad de medida no existe.');
			return redirect('administracion/unidades');
		}
	}

	public function update($id, UnidadRequest $request)
	{
		try
		{
			$unidad = UnidadMedida::findOrFail($id);
			$input = $request->all();
			
			$unidad->update($input);

			\Session::flash('noticia', 'La unidad de medida "'.$unidad->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La unidad de medida no existe.');
		}
		return redirect('administracion/unidades');
	}

	public function destroy($id)
	{
		try
		{
			$unidad = UnidadMedida::findOrFail($id);
			$unidad->delete();
			\Session::flash('noticia', 'La unidad de medida "'.$unidad->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La unidad de medida no existe.');
		}
		return redirect('administracion/unidades');
	}
}
