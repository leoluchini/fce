@extends('layouts.app_back')

@section('content')
@include('variables.form',['metodo' => 'POST',
							'titulo' => 'Nueva Variable para "'.$categoria->nombre.'"',
							'accion' => ['VariableController@store',$categoria->id],
							'accion_breadcrumb' => 'Crear Variable',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection