@extends('layouts.app_back')

@section('content')
@include('categorias_variables.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de Categoria de variable',
							'accion' => ['CategoriaVariableController@update', $categoria->id],
							'accion_breadcrumb' => 'Editar Categoria',
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection