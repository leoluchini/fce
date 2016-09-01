<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Categoria;

class PublicoController extends Controller
{
	public function publicaciones()
	{
		$data['categorias'] = Categoria::all();
		return view('frontend.publicaciones', $data);
	}

    public function variables()
	{
		return view('frontend.variables');
	}
	  public function indicadores()
	{
		return view('frontend.indicadores');
	}
}
