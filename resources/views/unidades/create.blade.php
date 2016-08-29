@extends('layouts.app')

@section('content')
@include('unidades.form',['metodo' => 'POST',
							'titulo' => 'Nueva Unidad',
							'accion' => ['UnidadController@store'],
							'boton' => 'Crear',
							'cancelar' => action('UnidadController@index'),
])
@endsection