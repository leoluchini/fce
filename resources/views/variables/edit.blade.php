@extends('layouts.app_back')

@section('content')
@include('variables.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de la variable "'.$variable->nombre.'"',
							'accion' => ['VariableController@update', $categoria->id, $variable->id],
							'accion_breadcrumb' => 'Editar Variable',
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection