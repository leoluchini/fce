@extends('layouts.app')

@section('content')
@include('frecuencias.form',['metodo' => 'POST',
							'titulo' => 'Nueva Frecuencia',
							'accion' => ['FrecuenciaController@store'],
							'boton' => 'Crear',
							'cancelar' => action('FrecuenciaController@index'),
])
@endsection