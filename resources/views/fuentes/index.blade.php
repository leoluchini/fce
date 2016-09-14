@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-1"> 
      <div class=" pull-left"> 
        <h4>
          <span class="glyphicon glyphicon-record"></span>
          Listado de Fuentes
        </h4>
      </div>
    </div>
     <div class="col-md-5">
      <h4 class="pull-right">
        <a title="Nueva fuente" href="{{ action('FuenteController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
      </h4>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="row">
    	<div class="col-md-10 col-md-offset-1"> 
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
</div>
@endsection