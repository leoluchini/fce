@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
  		<div class="page-header">
  			@include('generic.breadcrumb_multiple',['modulo' => 'Datos del lote', 'enlaces' => array('Subir indicadores' => action('LecturaIndicadorController@index'), 'Lote' => action('LecturaIndicadorController@show', $lote->id))])

	      <h1>
	        <span class="icon-box-2"></span>
	        Datos del Lote {{$lote->id}}
	      </h1>

      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container">
   	<div class="col-xs-12"> 
   			<h4>Mostrando {{$datos->count()}} resultados de un total de {{$datos->total()}}</h4>
			<div style="overflow-y:scroll;max-height:500px">
				<table id="tabla_lote" class="table table-condensed">
				    <thead>
				      <tr style="background-color:white;">
				        <th>Indicador</th>
				        <th>Zona</th>
				        <th>Año/Frecuencia</th>
				        <th>Valor</th>
				        <th>Unidad</th>
				        <th>Fuente</th>
				      </tr>
				    </thead>
				    <tbody>
				        @foreach( $datos as $info )
				          <tr>
				              <td>{{ $info->indicador->nombre }}</td>
				              <td>{{ $info->zona->nombre }}</td>
				              <td>{{ $info->anio }}{{ ($info->frecuencia->tipo != 'ANIO') ? ' / '.$info->frecuencia->nombre : '' }}</td>
				              <td>
				              @if($info->dato_adicional())
				              	<span data-toggle="tooltip" data-position="top" title="{{$info->dato_adicional()}}">
				              		{{ number_format($info->valor, 2, ',', '.') }}
				              	</span>
				              @else
				              	{{ number_format($info->valor, 2, ',', '.') }}
				              @endif
				              </td>
				              <td>{{ $info->unidad_medida->nombre }}</td>
				              <td><span title="{{ $info->fuente->descripcion }}" data-toggle="tooltip" data-placement="top">{{ $info->fuente->codigo }}</span></td>
				          </tr>
				      @endforeach
				    </tbody>
			  	</table>
		  	</div>
		  	{{ $datos->render() }}
		</div>
	</div>
</div>
@endsection

@section('scripts_adicionales')
    <script src="{{ asset('js/jquery.floatThead.min.js') }}"></script>
	<script>
		$(function() {
		    $('#tabla_lote').floatThead({
			    scrollContainer: true
			});	   
		});
	</script>
@endsection