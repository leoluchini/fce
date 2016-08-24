@extends('layouts.app')

@section('content')
@include('fuentes.form',['metodo' => 'POST',
							'titulo' => 'Nueva Fuente',
							'accion' => ['FuenteController@store'],
							'boton' => 'Crear',
							'cancelar' => action('FuenteController@index'),
])
@endsection