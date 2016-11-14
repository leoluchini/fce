<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Categoria;

class FrontendPublicacionesController extends Controller
{
	public function publicaciones(Request $request)
	{
		$data['categorias'] = Categoria::all();
		$data['anios'] = get_anios(['' => 'Todos']);
		//$data['filtros']['busqueda'] = '/^(?=.*fi)(?=.*uno).*$/';
		if($request->isMethod('post')){
			$data['filtros'] = $request->all();
			if(isset($data['filtros']['busqueda']) && ($data['filtros']['busqueda'] != '')){
				$data['filtros']['regex'] = '/^';
				$palabras = explode(' ', $data['filtros']['busqueda']);
				foreach($palabras as $palabra){
					$data['filtros']['regex'] .= '(?=.*'.$palabra.')';
				}
				$data['filtros']['regex'] .= '.*$/';
			}
		}
		return view('frontend.publicaciones', $data);
	}
}
