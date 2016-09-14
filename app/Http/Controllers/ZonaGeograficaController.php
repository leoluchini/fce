<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ZonaGeografica;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Http\Requests\ZonaGeograficaRequest;

class ZonaGeograficaController extends Controller
{
    public function index()
	{
		$data['zonas'] = ZonaGeografica::all();
		return view('zonas.index', $data);
	}

	public function create()
	{
		$data['tipos_zonas'] = array('pais' => 'Pais', 'provincia' => 'Provincia', 'municipio' => 'Municipio');
		$paises = Pais::all()->lists('nombre', 'id')->toArray();
		$provincias = Provincia::all()->lists('nombre', 'id')->toArray();
		$data['paises'] = array('' => 'Seleccione un pais') + $paises;
		$data['provincias'] = array('' => 'Seleccione una provincia') + $provincias;
		return view('zonas.create', $data);
	}

	public function store(ZonaGeograficaRequest $request)
	{
		$input = $request->all();
		$datos = array('codigo' => $input['codigo'], 'nombre' => $input['nombre'], 'descripcion' => $input['descripcion']);
		switch ($input['tipo']) {
		    case 'pais':
		    	$zona = Pais::create($datos);
		        break;
		    case 'provincia':
		    	$datos['zona_padre_id'] = $input['zona_padre_id'];
		    	$zona = Provincia::create($datos);
		        break;
		    case 'municipio':
		    	$datos['zona_padre_id'] = $input['zona_padre_id'];
		    	$zona = Municipio::create($datos);
		        break;
		}
		\Session::flash('noticia', 'La zona geografica "'.$zona->nombre.'" fue creada con exito.');
		return redirect('administracion/zonas');
	}

	public function edit($tipo, $id)
	{
		try
		{
			switch ($tipo) {
			    case 'pais':
				    $data['zona'] = Pais::findOrFail($id);
			        break;
			    case 'provincia':
				    $data['zona'] = Provincia::findOrFail($id);
				    $data['padres'] = Pais::all()->lists('nombre', 'id');
			        break;
			    case 'municipio':
				    $data['zona'] = Municipio::findOrFail($id);
				    $data['padres'] = Provincia::all()->lists('nombre', 'id');
			        break;
			}
			return view('zonas.edit', $data);
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La zona geografica no existe.');
			return redirect('administracion/zonas');
		}
	}

	public function update($id, ZonaGeograficaRequest $request)
	{
		try
		{
			$input = $request->all();
			$datos = array('codigo' => $input['codigo'], 'nombre' => $input['nombre'], 'descripcion' => $input['descripcion']);
			switch ($input['tipo']) {
			    case 'pais':
				    $zona = Pais::findOrFail($id);
			        break;
			    case 'provincia':
				    $zona = Provincia::findOrFail($id);
				    $datos['zona_padre_id'] = $input['zona_padre_id'];
			        break;
			    case 'municipio':
			    	$zona = Municipio::findOrFail($id);
				    $datos['zona_padre_id'] = $input['zona_padre_id'];
			        break;
			}
			$zona->update($datos);

			\Session::flash('noticia', 'La zona geografica "'.$zona->nombre.'" fue actualizada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La zona geografica no existe.');
		}
		return redirect('administracion/zonas');
	}

	public function destroy($tipo, $id)
	{
		try
		{
			switch ($tipo) {
			    case 'pais':
			    	$zona = Pais::findOrFail($id);
			        break;
			    case 'provincia':
			    	$zona = Provincia::findOrFail($id);
			        break;
			    case 'municipio':
			    	$zona = Municipio::findOrFail($id);
			        break;
			}
			$zona->delete();
			\Session::flash('noticia', 'La zona geografica "'.$zona->nombre.'" fue eliminada con exito.');
		}
		catch(ModelNotFoundException $e)
		{
			\Session::flash('error', 'La zona geografica no existe.');
		}
		return redirect('administracion/zonas');
	}
}
