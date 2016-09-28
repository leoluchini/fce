@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="page-header">
    <div class="row">
      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-box-2"></span>
            Subir variables <small>(por lotes)</small>
          </h2>
        </div>
        <div class=" pull-right"> 
	      <a href="{{ route('administracion.lectura.create')}}" class='btn btn-primary'></span>Nueva lectura</a>
      	</div>
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
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotes as $lote)
						<tr>
							<td>{!! $lote->id!!}</td>
							<td>{!! $lote->created_at !!}</td>
							<td class="text-right">
								<a class="btn btn-link btn-xs" data-toggle="tooltip" data-placement="top" title="Ver" href="{{ route('administracion.lectura.show', $lote->id)}}">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
								</a>
								<a class="btn btn-link btn-xs confirm-delete" data-toggle="tooltip" data-placement="top" title="Borrar" href="{{ route('administracion.lectura.destroy', $lote->id)}}" data-method="delete" data-title="Eliminar Lote" data-confirm="¿Estas seguro que desea eliminar los datos del lote '{{$lote->id}}' ?">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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