@extends('layouts.app')

@section('content')
@include('publicaciones.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de la publicacion "'.$publicacion->nombre.'"',
							'accion' => ['PublicacionController@update',$publicacion->id],
							'boton' => 'Guardar',
							'cancelar' => action('PublicacionController@index', [$publicacion->categoria->id]),
])
@endsection