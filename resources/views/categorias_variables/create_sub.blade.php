@extends('layouts.app')

@section('content')
@include('categorias_variables.form',['metodo' => 'POST',
							'titulo' => 'Nueva Subcategoria de "'.$padre->nombre.'"',
							'accion' => ['CategoriaVariableController@store'],
							'boton' => 'Crear',
							'cancelar' => action('CategoriaVariableController@index'),
							'padre' => $padre,
])
@endsection