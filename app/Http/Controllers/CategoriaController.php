<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index()
	{
		$data['categorias'] = Categoria::orderBy('id')->get();
		return view('categorias.index', $data);
	}

	public function create()
	{
		$data['categoria'] = new Categoria;
		return view('categorias.create', $data);
	}

	public function store(CategoriaRequest $request)
	{
		$input = $request->all();
		$categoria = Categoria::create($input);

		\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue creada con exito.');
		return redirect('administracion/categorias');
	}

	public function edit($id)
	{
		try
		{
			$data['categoria'] = Categoria::findOrFail($id);
			return view('categorias.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias');
		}
	}

	public function update($id, CategoriaRequest $request)
	{
		try
		{
			$categoria = Categoria::findOrFail($id);
			$input = $request->all();
			
			$categoria->update($input);

			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias');
	}

	public function destroy($id)
	{
		try
		{
			$categoria = Categoria::findOrFail($id);
			$categoria->delete();
			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" y sus publicaciones fueron eliminadas con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias');
	}
}
