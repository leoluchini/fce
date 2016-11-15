@extends('layouts.app_back')

@section('content')
@include('indicadores.form',['metodo' => 'POST',
							'titulo' => 'Nueva indicador para "'.$categoria->nombre.'"',
							'accion' => ['IndicadorController@store',$categoria->id],
							'accion_breadcrumb' => 'Crear indicador',
							'boton' => 'Crear',
							'cancelar' => action('CategoriaIndicadorController@index'),
])
@endsection