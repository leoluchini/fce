@extends('layouts.app_back')

@section('content')
@include('fuentes.form',['metodo' => 'POST',
							'titulo' => 'Nueva Fuente',
							'accion' => ['FuenteController@store'],
							'accion_breadcrumb' => 'Crear',
							'boton' => 'Crear',
							'cancelar' => action('FuenteController@index'),
])
@endsection