@extends('layouts.app_back')

@section('content')
<div class='container'>
  <div class='btn-toolbar pull-right'>
  	<h4 class="pull-right">
    	<a title="Volver al Lote" href="{{ action('LecturaController@show', $lote->id) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-triangle-left"></span></a>
  	</h4>
  </div>
  <h2>Datos del Lote {{$lote->id}}</h2>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">

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
@endsection

@section('scripts_adicionales')
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>
@endsection