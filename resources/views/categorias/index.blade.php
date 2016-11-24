@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_simple',['modulo' => 'Categor&iacute;as y publicaciones'])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="pull-right">
          <div class="btn-group">
            <h3>
              <a title="Nueva categoria" href="{{ action('CategoriaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>
            </h3>
          </div>
        </div>

        <h1>
          <span class="icon-newspaper"></span>
          Categor&iacute;as y publicaciones
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
		            <th><strong>Publicaciones</strong></p> </th>
		            <th class="text-right"><p> <strong>Acciones</strong></p></th>
		        </tr>
		    </thead>
		    <tbody id="tabla-datos">
		        @include('categorias.datos',['categorias' => $categorias])
		    </tbody>
		</table>
	</div>
</div>

@endsection