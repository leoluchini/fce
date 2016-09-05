@extends('layouts.app_back')

@section('content')
	<div class='container'>
	  <div class='btn-toolbar pull-right'>
	    <div class='btn-group'>
	      <a href="{{ route('lectura.create')}}" class='btn btn-primary'></span>Nueva lectura</a>
	    </div>
	  </div>
	  <h2>Lotes de lectura de archivos</h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>N</th>
						<th>Fecha</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lotes as $lote)
					<tr>
						<td>{!! $lote->id!!}</td>
						<td>{!! $lote->created_at !!}</td>
						<td>
							<a class="btn btn-link btn-xs" data-toggle="tooltip" data-placement="top" title="Ver" href="{{ route('lectura.show', $lote->id)}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							<a class="btn btn-link btn-xs confirm-delete" data-toggle="tooltip" data-placement="top" title="Borrar" href="{{ route('lectura.destroy', $lote->id)}}" data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection