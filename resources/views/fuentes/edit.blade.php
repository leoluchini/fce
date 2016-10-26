@extends('layouts.app_back')

@section('content')
@include('fuentes.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de fuente',
							'accion' => ['FuenteController@update', $fuente->id],
							'accion_breadcrumb' => 'Editar',
							'boton' => 'Guardar',
							'cancelar' => action('FuenteController@index'),
])
@endsection