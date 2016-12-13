@extends('layouts.app_back')

@section('content')
@include('indicadores.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion del indicador "'.$indicador->nombre.'"',
							'accion' => ['IndicadorController@update', $categoria->id, $indicador->id],
							'accion_breadcrumb' => 'Editar indicador',
							'boton' => 'Guardar',
							'cancelar' => action('IndicadorController@index', $categoria->id),
])
@endsection