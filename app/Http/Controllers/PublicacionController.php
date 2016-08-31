<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Categoria;
use App\Models\Publicacion;
use App\Http\Requests\PublicacionRequest;

class PublicacionController extends Controller
{
    public function index($categoria_id)
	{
		try
		{
			$data['categoria'] = Categoria::findOrFail($categoria_id);
			return view('publicaciones.index', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('categorias');
		}
	}
	public function create($categoria_id)
	{
		try
		{
			$data['categoria'] = Categoria::findOrFail($categoria_id);
			$data['publicacion'] = new Publicacion;
			$data['anios'] = array_combine(range(2015, date('Y')), range(2015, date('Y')));
			return view('publicaciones.create', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('categorias');
		}
	}

	public function store($categoria_id, PublicacionRequest $request)
	{
		try
		{
			$categoria = Categoria::findOrFail($categoria_id);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La categoria no existe.');
			return redirect('categorias');
		}

		$archivo_pdf = \Request::file('archivo');

		$nombreFinal = save_file($archivo_pdf, $categoria->get_path());
		
		$input = $request->all();
		$input['archivo'] = $nombreFinal;
		$input['categoria_id'] = $categoria_id;
		$publicacion = Publicacion::create($input);

		\Session::flash('noticia', 'Se creo la publicacion "'.$publicacion->nombre.'" correctamente en la categoria "'.$categoria->nombre.'"');
		return redirect('categoria/'.$categoria_id.'/publicaciones');
	}

	public function edit($categoria_id, $id)
	{
		try
		{
			$data['publicacion'] = Publicacion::findOrFail($id);
			$data['categoria'] = Categoria::findOrFail($categoria_id);
			$data['anios'] = array_combine(range(2015, date('Y')), range(2015, date('Y')));
			return view('publicaciones.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La publicacion no existe.');
			return redirect('categoria/'.$categoria_id.'/publicaciones');
		}
	}

	public function update($categoria_id, $id, PublicacionRequest $request)
	{
		try
		{
			$publicacion = Publicacion::findOrFail($id);
			$input = $request->all();
			
			$publicacion->update($input);

			\Session::flash('noticia', 'La publicacion "'.$publicacion->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La publicacion no existe.');
			return redirect('categoria/'.$categoria_id.'/publicaciones');
		}
		return redirect('categoria/'.$categoria_id.'/publicaciones');
	}

	public function destroy($categoria_id, $id)
	{
		try
		{
			$publicacion = Publicacion::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La publicacion no existe.');
			return redirect('categoria/'.$categoria_id.'/publicaciones');
		}
		$publicacion->delete();

		\Session::flash('noticia', 'La publicacion "'.$publicacion->nombre.'" fue eliminada con exito.');
		
		return redirect('categoria/'.$categoria_id.'/publicaciones');
	}

	public function ver_archivo($id)
    {
    	try
    	{
    		$publicacion = Publicacion::findOrFail($id);
    	}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La publicacion no existe.');
			return redirect('categorias');
		}
        ver_pdf($publicacion->get_file_path(), 'publicaciones/'.$publicacion->categoria->id);
    }
    public function descargar_archivo($id)
    {
    	try
    	{
    		$publicacion = Publicacion::findOrFail($id);
    	}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La publicacion no existe.');
			return redirect('categorias');
		}
        descargar_pdf($publicacion->get_file_path(), 'publicaciones/'.$publicacion->categoria->id);
    }
    public function front()
		{
				return view('frontend.publicaciones');
		}
}
