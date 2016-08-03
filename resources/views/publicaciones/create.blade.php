@extends('layouts.app')

@section('content')
@include('publicaciones.form',['metodo' => 'POST',
							'titulo' => 'Nueva Publicacion para "'.$categoria->nombre.'"',
							'accion' => ['PublicacionController@store',$categoria->id],
							'boton' => 'Crear',
							'cancelar' => action('PublicacionController@index', [$categoria->id]),
])
@endsection