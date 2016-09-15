<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CategoriaVariable;
use App\Http\Requests\CategoriaVariableRequest;

class CategoriaVariableController extends Controller
{
    public function index()
	{
		$data['categorias'] = CategoriaVariable::all();
		return view('categorias_variables.index', $data);
	}

	public function create()
	{
		$data['categoria'] = new CategoriaVariable;
		return view('categorias_variables.create', $data);
	}

	public function create_sub($id)
	{
		$data['categoria'] = new CategoriaVariable;
		$data['padre'] = CategoriaVariable::findOrFail($id);
		return view('categorias_variables.create_sub', $data);
	}

	public function store(CategoriaVariableRequest $request)
	{
		$input = $request->all();
		$categoria = CategoriaVariable::create($input);

		\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue creada con exito.');
		return redirect('administracion/categorias_variables');
	}


	public function edit($id)
	{
		try
		{
			$data['categoria'] = CategoriaVariable::findOrFail($id);
			return view('categorias_variables.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_variables');
		}
	}

	public function update($id, CategoriaVariableRequest $request)
	{
		try
		{
			$categoria = CategoriaVariable::findOrFail($id);
			$input = $request->all();
			
			$categoria->update($input);

			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias_variables');
	}

	public function destroy($id)
	{
		try
		{
			$categoria = CategoriaVariable::findOrFail($id);
			$categoria->delete();
			\Session::flash('noticia', 'La categoria "'.$categoria->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
		}
		return redirect('administracion/categorias_variables');
	}
}
