<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CategoriaIndicador;
use App\Http\Requests\CategoriaIndicadorRequest;

class CategoriaIndicadorController extends Controller
{
    public function index()
	{
		$data['categorias'] = CategoriaIndicador::whereNull('categoria_padre_id')->orderBy('id')->paginate(25);
		return view('categorias_indicadores.index', $data);
	}

	public function create()
	{
		$data['categoria'] = new CategoriaIndicador;
		return view('categorias_indicadores.create', $data);
	}

	public function create_sub($id)
	{
		$data['categoria'] = new CategoriaIndicador;
		$data['padre'] = CategoriaIndicador::findOrFail($id);
		return view('categorias_indicadores.create_sub', $data);
	}

	public function store(CategoriaIndicadorRequest $request)
	{
		$input = $request->all();
		$categoria = CategoriaIndicador::create($input);

		\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue creada con exito.');
		return redirect('administracion/categorias_indicadores');
	}


	public function edit($id)
	{
		try
		{
			$data['categoria'] = CategoriaIndicador::findOrFail($id);
			return view('categorias_indicadores.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_indicadores');
		}
	}

	public function update($id, CategoriaIndicadorRequest $request)
	{
		try
		{
			$categoria = CategoriaIndicador::findOrFail($id);
			$input = $request->all();
			
			$categoria->update($input);

			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias_indicadores');
	}

	public function destroy($id)
	{
		try
		{
			$categoria = CategoriaIndicador::findOrFail($id);
			$categoria->delete();
			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias_indicadores');
	}

	
}
