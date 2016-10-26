@extends('layouts.app_back')

@section('content')
@include('categorias_variables.form',['metodo' => 'POST',
							'titulo' => 'Nueva Categoria',
							'accion' => ['CategoriaVariableController@store'],
							'accion_breadcrumb' => 'Crear Categoria',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection