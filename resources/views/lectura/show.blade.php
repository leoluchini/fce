@extends('layouts.app_back')

@section('content')
	<div class='container'>
	  <div class='btn-toolbar pull-right'>
	    <div class='btn-group'>
	      <a href="{{ route('administracion.lectura.destroy', $lote->id)}}" class='btn btn-danger' data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Borrar lote</a>
	    </div>
	  </div>
	  <h2>Lectura de archivos</h2>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ul class="list-group">
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->categorias->count() !!}</span>
			    Categorias
			  </li>
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->variables->count() !!}</span>
			    Variables
			  </li>
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->unidades->count() !!}</span>
			    Unidades de medidas
			  </li>
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->zonas->count() !!}</span>
			    Zonas Geograficas
			  </li>
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->fuentes->count() !!}</span>
			    Fuentes
			  </li>
			  <li class="list-group-item">
			    <span class="badge">{!! $lote->datos->count() !!}</span>
			    Datos
			  </li>
			</ul>
			
		</div>
	</div>
@endsection