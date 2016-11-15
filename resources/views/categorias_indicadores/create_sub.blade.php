@extends('layouts.app_back')

@section('content')
@include('categorias_indicadores.form',['metodo' => 'POST',
							'titulo' => 'Nueva subcategor&iacute;a de "'.$padre->nombre.'"',
							'accion' => ['CategoriaIndicadorController@store'],
							'accion_breadcrumb' => 'Nueva categor&iacute;a',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaIndicadorController@index'),
							'padre' => $padre,
])
@endsection