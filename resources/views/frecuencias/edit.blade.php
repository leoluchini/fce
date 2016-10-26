@extends('layouts.app_back')

@section('content')
@include('frecuencias.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de frecuencia',
							'accion' => ['FrecuenciaController@update', $frecuencia->id],
							'accion_breadcrumb' => 'Editar',
							'boton' => 'Guardar',
							'cancelar' => action('FrecuenciaController@index'),
])
@endsection