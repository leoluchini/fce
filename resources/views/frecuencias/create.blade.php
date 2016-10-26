@extends('layouts.app_back')

@section('content')
@include('frecuencias.form',['metodo' => 'POST',
							'titulo' => 'Nueva Frecuencia',
							'accion' => ['FrecuenciaController@store'],
							'accion_breadcrumb' => 'Crear',
							'boton' => 'Crear',
							'cancelar' => action('FrecuenciaController@index'),
])
@endsection