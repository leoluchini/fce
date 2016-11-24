@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => 'Publicaciones', 'enlaces' => array('Categor&iacute;as y publicaciones' => action('CategoriaController@index'))])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="pull-right">
          <div class="btn-group">
            <h3>
              <a title="Nueva publicacion" href="{{ action('PublicacionController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>
            </h3>
        </div>
        </div>
        <h1>
          <span class="icon-newspaper"></span>
          Listado de Publicaciones de la categor&iacute;a '{{$categoria->nombre}}'
        </h1>
      </div>
    </div>
  </div>

  	<div class="col-xs-12"> 
		<table class="tabla table-responsive table table-hover table-condensed">
		    <thead>
		        <tr>
		            <th><strong>Nombre</strong></p> </th>
		            <th><strong>Descripci&oacute;n</strong></p> </th>
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

@endsection