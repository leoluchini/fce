@extends('layouts.app_back')

@section('content')
@include('fuentes.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de fuente',
							'accion' => ['FuenteController@update', $fuente->id],
							'boton' => 'Guardar',
							'cancelar' => action('FuenteController@index'),
])
@endsection