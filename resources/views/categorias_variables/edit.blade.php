@extends('layouts.app')

@section('content')
@include('categorias_variables.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de Categoria de variable',
							'accion' => ['CategoriaVariableController@update', $categoria->id],
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaVariableController@index'),
])
@endsection