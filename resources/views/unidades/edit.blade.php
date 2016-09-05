@extends('layouts.app_back')

@section('content')
@include('unidades.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de unidad',
							'accion' => ['UnidadController@update', $unidad->id],
							'boton' => 'Guardar',
							'cancelar' => action('UnidadController@index'),
])
@endsection