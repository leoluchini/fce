<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PublicoController extends Controller
{
    public function variables()
	{
		return view('frontend.variables');
	}
	  public function indicadores()
	{
		return view('frontend.indicadores');
	}
}
