@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        @include('generic.breadcrumb_multiple',['modulo' => 'Publicaciones', 'enlaces' => array('Categorias' => action('CategoriaController@index'))])
        <div class="pull-right">
          <div class="btn-group">
            <a title="Nueva publicacion" href="{{ action('PublicacionController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>
        <h2>
          <span class="icon-newspaper"></span>
          Listado de Publicaciones de la categoria '{{$categoria->nombre}}'
        </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="container">
    	<div class="col-xs-12"> 
			<table class="tabla table-responsive table table-hover table-condensed">
			    <thead>
			        <tr>
			            <th><strong>Nombre</strong></p> </th>
			            <th><strong>Descripcion</strong></p> </th>
			            <th><strong>Año de publicación</strong></p> </th>
			            <th class="text-right"><p> <strong>Acciones</strong></p></th>
			        </tr>
			    </thead>
			    <tbody id="tabla-datos">
			        @include('publicaciones.datos',['publicaciones' => $categoria->publicaciones])
			    </tbody>
			</table>
		</div>
	</div>
</div>
@endsection