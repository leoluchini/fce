@extends('layouts.app_back')

@section('content')
@include('categorias.form',['metodo' => 'POST',
							'titulo' => 'Nueva Categor&iacute;a',
							'accion' => ['CategoriaController@store'],
							'accion_breadcrumb' => 'Crear',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaController@index'),
])
@endsection