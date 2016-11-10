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
				<table class="table">
					<thead>
						<tr>
							<th>N</th>
							<th>Fecha</th>
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
							<td>{!! $lote->estado !!}</td>
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
			</div>
		</div>
	</div>
</div>
@endsection