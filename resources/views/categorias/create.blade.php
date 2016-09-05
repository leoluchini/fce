@extends('layouts.app_back')

@section('content')
@include('categorias.form',['metodo' => 'POST',
							'titulo' => 'Nueva Categoria',
							'accion' => ['CategoriaController@store'],
							'boton' => 'Crear',
							'cancelar' => action('CategoriaController@index'),
])
@endsection