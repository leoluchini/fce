@extends('layouts.app_back')

@section('content')
@include('categorias_variables.form',['metodo' => 'POST',
							'titulo' => 'Nueva Categoria',
							'accion' => ['CategoriaVariableController@store'],
							'boton' => 'Crear',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection