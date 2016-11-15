@extends('layouts.app_back')

@section('content')
@include('categorias_indicadores.form',['metodo' => 'POST',
							'titulo' => 'Nueva categor&iacute;a',
							'accion' => ['CategoriaIndicadorController@store'],
							'accion_breadcrumb' => 'Crear Categoria',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaIndicadorController@index'),
])
@endsection