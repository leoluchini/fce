@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Library</a></li>
          <li class="active">Data</li>
        </ol>
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
</div>


<div class="page-body">
  <div class="container">
    <div class="row">
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
	</div>
</div>
@endsection