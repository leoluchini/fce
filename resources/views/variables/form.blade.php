<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>{{$titulo}}</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($variable, array('action' => $accion, 'method' => $metodo, 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		{!! Form::hidden('categoria_id', $categoria->id, array('class' => 'form-control')) !!}
		@include('generic.campos_comunes',['object' => $variable])
		<div class="form-group">
			{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>