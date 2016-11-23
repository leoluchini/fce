@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_simple',['modulo' => 'Fuentes'])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="pull-right">
          <div class="btn-group">
             <a title="Nueva fuente" href="{{ action('FuenteController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>

        <h1>
          <span class="icon-archive-1"></span>
          Fuentes
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
		            <th class="text-right"><p> <strong>Acciones</strong></p></th>
		        </tr>
		    </thead>
		    <tbody id="tabla-datos">
		        @include('fuentes.datos',['fuentes' => $fuentes])
		    </tbody>
		</table>
  </div>
</div>

@endsection