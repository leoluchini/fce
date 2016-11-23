@extends('layouts.app_back')

@section('content')
<div class="container">
	@include('generic.breadcrumb_multiple',['modulo' => 'Lote', 'enlaces' => array('Subir indicadores' => action('LecturaIndicadorController@index'))])
  <div class="row">
    <div class="col-xs-12"> 
  		<div class="page-header">
			<div class="pull-right">
		        <div class="btn-group">
	     				<a href="{{ route('administracion.lectura.destroy', $lote->id)}}" data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Borar lote"><span class="icon-trash-4"></span></a>
				      	<strong>Estado: {{ $lote->estadoActual }}</strong>
				      	@if($lote->estado == $lote::ESTADO_FINALIZADO)
		     				<a href="{{ route('administracion.lectura_indicador.lote.aceptar', $lote->id)}}" data-titulo="Aceptar Lote" data-mensaje="¿Estas seguro que desea aceptar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Aceptar lote" class="confirm_modal pull-right"><span class="icon-toggle-off"></span></a>
		     			@endif
		     			@if($lote->estado == $lote::ESTADO_ACEPTADO)
		     				<a href="{{ route('administracion.lectura_indicador.lote.desactivar', $lote->id)}}" data-titulo="Desactivar Lote" data-mensaje="¿Estas seguro que desea desactivar los datos del lote '{{$lote->id}}' ?" data-toggle="tooltip" data-placement="top" title="Desactivar lote" class="confirm_modal pull-right"><span class="icon-toggle-on"></span></a>
		     			@endif
	        </div>
	      </div>

	      <h1>
	        <span class="icon-box-2"></span>
	        Lote
	      </h1>
      </div>
    </div>
  </div>
</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="overflow:auto;">
	          
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingCategorias">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCategorias" aria-expanded="true" aria-controls="collapseCategorias">
	                    <span class="badge pull-right">{!! $lote->categorias->count() !!}</span>
			    		<p class="blanco">Categorias</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseCategorias" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCategorias">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->categorias as $categoria)
	                      <li class="list-group-item">{{$categoria->nombre}}</li>
	                    @endforeach
	                  </ul>
	                </div>
	              </div>
	            </div>
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingVariables">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseVariables" aria-expanded="true" aria-controls="collapseVariables">
	                    <span class="badge pull-right">{!! $lote->indicadores->count() !!}</span>
			    		<p class="blanco">Indicadores</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseVariables" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingVariables">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->indicadores as $indicador)
	                      <li class="list-group-item">{{$indicador->nombre}}</li>
	                    @endforeach
	                  </ul>
	                </div>
	              </div>
	            </div>
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingUnidades">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseUnidades" aria-expanded="true" aria-controls="collapseUnidades">
	                    <span class="badge pull-right">{!! $lote->unidades->count() !!}</span>
			    		<p class="blanco">Unidades de medida</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseUnidades" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingUnidades">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->unidades as $unidad)
	                      <li class="list-group-item">{{$unidad->nombre}}</li>
	                    @endforeach
	                  </ul>
	                </div>
	              </div>
	            </div>
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingZonas">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseZonas" aria-expanded="true" aria-controls="collapseZonas">
	                    <span class="badge pull-right">{!! $lote->zonas->count() !!}</span>
		    			<p class="blanco">Zonas Geograficas</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseZonas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingZonas">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->zonas as $zona)
	                      <li class="list-group-item">{{$zona->nombre}}</li>
	                    @endforeach
	                  </ul>
	                </div>
	              </div>
	            </div>
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingFuentes">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFuentes" aria-expanded="true" aria-controls="collapseFuentes">
	                    <span class="badge pull-right">{!! $lote->fuentes->count() !!}</span>
			    		<p class="blanco">Fuentes</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseFuentes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFuentes">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->fuentes as $fuente)
	                      <li class="list-group-item">{{$fuente->nombre}}</li>
	                    @endforeach
	                  </ul>
	                </div>
	              </div>
	            </div>
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingDatos">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDatos" aria-expanded="true" aria-controls="collapseDatos">
	                    <a href="{{action('LecturaIndicadorController@datos_lote', $lote->id)}}">
	                    	<span class="badge pull-right">{!! $cantidad !!}</span>
	                    </a>
			    		<p class="blanco">Datos</p>
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseDatos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDatos">
	              </div>
	            </div>
	        </div>		
		</div>
	</div>
@endsection