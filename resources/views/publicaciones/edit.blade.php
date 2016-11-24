@extends('layouts.app_back')

@section('content')
@include('publicaciones.form',['metodo' => 'PATCH',
							'titulo' => 'Edici&oacute;n de la publicaci&oacute;n "'.$publicacion->nombre.'"',
							'accion' => ['PublicacionController@update', $categoria->id, $publicacion->id],
							'accion_breadcrumb' => 'Editar',
							'boton' => 'Guardar',
							'cancelar' => action('PublicacionController@index', [$categoria->id]),
])
@endsection