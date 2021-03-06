@extends('layouts.app_back')

@section('content')
  <div class="container">
  	@include('generic.breadcrumb_multiple',['modulo' => 'Datos del lote', 'enlaces' => array('Subir variables' => action('LecturaController@index'), 'Lote' => action('LecturaController@show', $lote->id))])
		@include('lectura.navs')
		<div class="row">
   	<div class="col-xs-12"> 
   			<h4>Mostrando {{$datos->count()}} resultados de un total de {{$datos->total()}}</h4>
				<table id="tabla_lote" class="table table-condensed">
				    <thead>
				      <tr style="background-color:white;">
				        <th>Variable</th>
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
				              <td>{{ $info->variable->nombre }}</td>
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
		  	{{ $datos->render() }}
		</div>
	</div>
</div>
@endsection