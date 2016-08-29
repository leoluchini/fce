@extends('layouts.app')

@section('content')
<div class="page-header">
  <div class="row">
    <div class="col-md-5 col-md-offset-1"> 
      <div class=" pull-left"> 
        <h4>
          <span class="glyphicon glyphicon-record"></span>
          Listado de Publicaciones
        </h4>
      </div>
    </div>
     <div class="col-md-5">
      <h4 class="pull-right">
        
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
			            <th><strong>Nombre</strong></p> </th>
			            <th><strong>Descripcion</strong></p> </th>
			            <th><strong>Año de publicación</strong></p> </th>
			            <th class="text-right"><p> <strong>Acciones</strong></p></th>
			        </tr>
			    </thead>
			    <tbody id="tabla-datos">
			        <tr>
                <td>una publicacion</td>
                <td>descripcion</td>
                <td>2016</td>
                <td class="text-right">
                </td>
              </tr>
			    </tbody>
			</table>
		</div>
	</div>
</div>
@endsection