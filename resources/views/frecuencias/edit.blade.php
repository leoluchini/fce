@extends('layouts.app_back')

@section('content')
@include('frecuencias.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de frecuencia',
							'accion' => ['FrecuenciaController@update', $frecuencia->id],
							'boton' => 'Guardar',
							'cancelar' => action('FrecuenciaController@index'),
])
@endsection