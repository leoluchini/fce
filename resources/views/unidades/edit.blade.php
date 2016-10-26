@extends('layouts.app_back')

@section('content')
@include('unidades.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de unidad',
							'accion' => ['UnidadController@update', $unidad->id],
							'accion_breadcrumb' => 'Editar',
							'boton' => 'Guardar',
							'cancelar' => action('UnidadController@index'),
])
@endsection