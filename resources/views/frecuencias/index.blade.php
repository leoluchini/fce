@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_simple',['modulo' => 'Frecuencias'])
  <div class="row">
    <div class="col-xs-12"> 
  		<div class="page-header">
		  <div class="pull-right">
	        <div class="btn-group">
	        	<h3>
	        	<a title="Nueva frecuencia" href="{{ action('FrecuenciaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>
	        	</h3>
	        </div>
	      </div>

	      <h1>
	        <span class="icon-calendar-8"></span>
          Frecuencias
	      </h1>

      </div>
    </div>
  </div>

  	<div class="col-md-12"> 
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

@endsection