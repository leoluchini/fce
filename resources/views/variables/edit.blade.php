@extends('layouts.app_back')

@section('content')
@include('variables.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de la variable "'.$variable->nombre.'"',
							'accion' => ['VariableController@update', $categoria->id, $variable->id],
							'accion_breadcrumb' => 'Editar variable',
							'boton' => 'Guardar',
							'cancelar' => action('VariableController@index', $categoria->id),
])
@endsection