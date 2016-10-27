@extends('layouts.app_back')

@section('content')
@include('categorias_variables.form',['metodo' => 'POST',
							'titulo' => 'Nueva subcategor&iacute;a de "'.$padre->nombre.'"',
							'accion' => ['CategoriaVariableController@store'],
							'accion_breadcrumb' => 'Nueva categor&iacute;a',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaVariableController@index'),
							'padre' => $padre,
])
@endsection