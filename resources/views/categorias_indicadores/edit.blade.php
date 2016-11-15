@extends('layouts.app_back')

@section('content')
@include('categorias_indicadores.form',['metodo' => 'PATCH',
							'titulo' => 'Edicion de categor&iacute;a',
							'accion' => ['CategoriaIndicadorController@update', $categoria->id],
							'accion_breadcrumb' => 'Editar Categoria',
							'boton' => 'Guardar',
							'cancelar' => action('CategoriaIndicadorController@index'),
])
@endsection