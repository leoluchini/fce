@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
  		<div class="page-header">
  		@include('generic.breadcrumb_simple',['modulo' => 'Subir variables'])
			<div class="pull-right">
		        <div class="btn-group">
		          <a title="Nueva lectura" href="{{ route('administracion.lectura.create')}}" data-toggle="tooltip" data-placement="top"><span class="icon-upload-outline"></span></a>
		        </div>
		    </div>

	      <h1>
	        <span class="icon-upload-cloud-outline"></span>
	        Subir variables <small>(por lotes)</small>
	      </h1>

      </div>
    </div>
  </div>
</div>



<div class="page-body">
  <div class="container">
    <div class="row">

			<div class="col-md-12">
				<h4>Mostrando {{$lotes->count()}} lotes de un total de {{$lotes->total()}}</h4>
				<div class="pull-right">
				{!! Form::open(array('action' => ['LecturaController@index'], 'method' => 'GET')) !!}
					<p>Desde: <input type="text" name="fecha_desde" class="input_date_picker">&nbsp;&nbsp;Hasta: <input type="text" name="fecha_hasta" class="input_date_picker"> <button class="btn btn-default" type="submit">Filtrar</button></p>
				{!! Form::close() !!}
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>N</th>
							<th>Fecha</th>
							<th>Responsable</th>
							<th>Estado</th>
							<th>Error</th>
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotes as $lote)
						<tr>
							<td>{!! $lote->id!!}</td>
							<td>{!! $lote->created_at !!}</td>
							<td>{!! $lote->usuario !!}</td>
							<td>{!! $lote->estadoActual !!}</td>
							<td>{!! $lote->error !!}</td>
							<td class="text-right">
								<a class="btn btn-link btn-xs" data-toggle="tooltip" data-placement="top" title="Ver" href="{{ route('administracion.lectura.show', $lote->id)}}">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								</a>
								<a class="btn btn-link btn-xs confirm-delete" data-toggle="tooltip" data-placement="top" title="Borrar" href="{{ route('administracion.lectura.destroy', $lote->id)}}" data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?">
									<span class="icon-trash-4"></span>
								</a>
								</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{ $lotes->render() }}
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts_adicionales')
    <link href="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.css') }}" rel="stylesheet">*
    <script src="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('jquery-ui-1.12.0.smoothness/i18n/datepicker-es.js') }}"></script>
	<script>
		$(function() {
    		$( ".input_date_picker" ).datepicker();
		});
	</script>
@endsection