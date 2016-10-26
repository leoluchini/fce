<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Fuente;
use App\Http\Requests\FuenteRequest;

class FuenteController extends Controller
{
    public function index()
	{
		$data['fuentes'] = Fuente::orderBy('id')->get();
		return view('fuentes.index', $data);
	}

	public function create()
	{
		$data['fuente'] = new Fuente;
		return view('fuentes.create', $data);
	}

	public function store(FuenteRequest $request)
	{
		$input = $request->all();
		$fuente = Fuente::create($input);

		\Session::flash('noticia', 'La fuente "'.$fuente->nombre.'" fue creada con exito.');
		return redirect('administracion/fuentes_informacion');
	}

	public function edit($id)
	{
		try
		{
			$data['fuente'] = Fuente::findOrFail($id);
			return view('fuentes.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La fuente no existe.');
			return redirect('administracion/fuentes_informacion');
		}
	}

	public function update($id, FuenteRequest $request)
	{
		try
		{
			$fuente = Fuente::findOrFail($id);
			$input = $request->all();
			
			$fuente->update($input);

			\Session::flash('noticia', 'La fuente "'.$fuente->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La fuente no existe.');
		}
		return redirect('administracion/fuentes_informacion');
	}

	public function destroy($id)
	{
		try
		{
			$fuente = Fuente::findOrFail($id);
			$fuente->delete();
			\Session::flash('noticia', 'La fuente "'.$fuente->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La fuente no existe.');
		}
		return redirect('administracion/fuentes_informacion');
	}
}
