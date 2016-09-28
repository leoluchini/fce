@extends('layouts.app_back')

@section('content')

<div class="container">
  <div class="page-header">
    <div class="row">
      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-box-2"></span>
            Frecuencias
          </h2>
        </div>
        <div class="pull-right">
	      	<h4>
	        	<a title="Nueva frecuencia" href="{{ action('FrecuenciaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
	      	</h4>
    		</div>
      </div>
    </div>
  </div>
</div>


<div class="page-body">
	<div class="row">
    	<div class="col-md-10 col-md-offset-1"> 
			<table class="tabla table-responsive table table-hover table-condensed">
			    <thead>
			        <tr>
			            <th><strong>Tipo</strong></p> </th>
			            <th><strong>Codigo</strong></p> </th>
			            <th><strong>Nombre</strong></p> </th>
			            <th class="text-right"><p> <strong>Acciones</strong></p></th>
			        </tr>
			    </thead>
			    <tbody id="tabla-datos">
			      @include('frecuencias.datos',['frecuencias' => $frecuencias])
			    </tbody>
			</table>
		</div>
	</div>
</div>
@endsection