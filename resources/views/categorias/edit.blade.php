@extends('layouts.app_back')

@section('content')
@include('categorias.form',['metodo' => 'PATCH',
							'titulo' => 'Edici&oacute;n de categor&iacute;as y publicaciones',
							'accion' => ['CategoriaController@update', $categoria->id],
							'accion_breadcrumb' => 'Editar',
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaController@index'),
])
@endsection