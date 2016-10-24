@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">

        <div class="pull-right">
          <div class="btn-group">
            <a title="Nueva categoria" href="{{ action('CategoriaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>

        <h1>
          <span class="icon-newspaper"></span>
          Categorías y publicaciones
        </h1>

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
</div>
@endsection