@extends('layouts.app')

@section('content')
@include('categorias.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de categoria',
							'accion' => ['CategoriaController@update', $categoria->id],
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaController@index'),
])
@endsection