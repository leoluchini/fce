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
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	          
	            <div class="panel panel-default">
	              <div class="panel-heading" role="tab" id="headingCategorias">
	                <h4 class="panel-title">
	                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCategorias" aria-expanded="true" aria-controls="collapseCategorias">
	                    <span class="badge pull-right">{!! $lote->categorias->count() !!}</span>
			    		Categorias
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
	                    <span class="badge pull-right">{!! $lote->variables->count() !!}</span>
			    		Variables
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseVariables" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingVariables">
	                <div class="panel-body">
	                  <ul class="list-group">
	                    @foreach($lote->variables as $variable)
	                      <li class="list-group-item">{{$variable->nombre}}</li>
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
			    		Unidades de medida
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
		    			Zonas Geograficas
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
			    		Fuentes
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
	                    <span class="badge pull-right">{!! $lote->datos->count() !!}</span>
			    		Datos
	                  </a>
	                </h4>
	              </div>
	              <div id="collapseDatos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDatos">
	                <div class="panel-body">
	                   <table class="table table-condensed tabla_resultados_paginada">
				        <thead>
				          <tr>
				            <th>Variable</th>
				            <th>Zona</th>
				            <th>Año/Frecuencia</th>
				            <th>Valor</th>
				            <th>Unidad</th>
				            <th>Fuente</th>
				          </tr>
				        </thead>
				        <tbody>
				            @foreach( $lote->datos as $info )
				              <tr>
				                  <td>{{ $info->variable->nombre }}</td>
				                  <td>{{ $info->zona->nombre }}</td>
				                  <td>{{ $info->anio }}{{ ($info->frecuencia->tipo != 'ANIO') ? ' / '.$info->frecuencia->nombre : '' }}</td>
				                  <td>{{ number_format($info->valor, 2, ',', '.') }}</td>
				                  <td>{{ $info->unidad_medida->nombre }}</td>
				                  <td><span title="{{ $info->fuente->descripcion }}" data-toggle="tooltip" data-placement="top">{{ $info->fuente->codigo }}</span></td>
				              </tr>
				          @endforeach
				        </tbody>
				      </table>
	                </div>
	              </div>
	            </div>
	        </div>		
		</div>
	</div>
@endsection

@section('scripts_adicionales')
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>
@endsection
