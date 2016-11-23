@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_simple',['modulo' => 'Unidades'])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="pull-right">
          <div class="btn-group">
            <a title="Nueva unidad" href="{{ action('UnidadController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>

        <h1>
          <span class="icon-ruler"></span>
          Unidades
        </h1>

      </div>
    </div>
  </div>

 	<div class="col-xs-12"> 
		<table class="tabla table-responsive table table-hover table-condensed">
		    <thead>
		        <tr>
		            <th><strong>Codigo</strong></p> </th>
		            <th><strong>Nombre</strong></p> </th>
		            <th><strong>Descripcion</strong></p> </th>
		            <th class="text-right"><p> <strong>Acciones</strong></p></th>
		        </tr>
		    </thead>
		    <tbody id="tabla-datos">
		        @include('unidades.datos',['unidades' => $unidades])
		    </tbody>
		</table>
	</div>
</div>

@endsection