@extends('layouts.app_back')

@section('content')
@include('publicaciones.form',['metodo' => 'POST',
							'titulo' => 'Nueva Publicacion para "'.$categoria->nombre.'"',
							'accion' => ['PublicacionController@store',$categoria->id],
							'accion_breadcrumb' => 'Crear',
							'boton' => 'Crear',
							'cancelar' => action('PublicacionController@index', [$categoria->id]),
])
@endsection