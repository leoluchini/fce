<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CategoriaVariable;
use App\Models\Variable;
use App\Models\Tema;
use App\Models\VariableSinResultados;
use App\Http\Requests\VariableRequest;

class VariableController extends Controller
{
	public function create($categoria_id)
	{
		try
		{
			$data['categoria'] = CategoriaVariable::findOrFail($categoria_id);
			$data['variable'] = new Variable;
			return view('variables.create', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_variables');
		}
	}

	public function store($categoria_id, VariableRequest $request)
	{
		try
		{
			$categoria = CategoriaVariable::findOrFail($categoria_id);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('administracion/categorias_variables');
		}
		$input = $request->all();
		$variable = Variable::create($input);

		\Session::flash('noticia', 'Se creo la variable "'.$variable->nombre.'" correctamente en la categoria "'.$categoria->nombre.'"');
		return redirect('administracion/categorias_variables');
	}

	public function edit($categoria_id, $id)
	{
		try
		{
			$data['variable'] = Variable::findOrFail($id);
			$data['categoria'] = CategoriaVariable::findOrFail($categoria_id);
			return view('variables.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La variable no existe.');
			return redirect('administracion/categorias_variables');
		}
	}

	public function update($categoria_id, $id, VariableRequest $request)
	{
		try
		{
			$variable = Variable::findOrFail($id);
			$input = $request->all();
			
			$variable->update($input);

			\Session::flash('noticia', 'La variable "'.$variable->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La variable no existe.');
			return redirect('administracion/categorias_variables');
		}
		return redirect('administracion/categorias_variables');
	}

	public function destroy($categoria_id, $id)
	{
		try
		{
			$variable = Variable::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La variable no existe.');
			return redirect('administracion/categorias_variables');
		}
		$variable->delete();

		\Session::flash('noticia', 'La variable "'.$variable->nombre.'" fue eliminada con exito.');
		
		return redirect('administracion/categorias_variables');
	}

	public function temas()
	{
		//$data['temas'] = Tema::all();
		$temas_variables = Variable::select('variables.tema_id')->distinct()->whereNotNull('tema_id')->get()->lists('tema_id')->toArray();
		$data['temas'] = Tema::whereIn('temas.id', $temas_variables)->get();
		$data['variables'] = Variable::whereNull('tema_id')->get();
		return view('variables.temas', $data);
	}
	public function busquedas()
	{
		$data['busquedas'] = VariableSinResultados::all();
		return view('variables.busquedas', $data);
	}
}
