<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>{{$titulo}}</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($categoria, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		@include('generic.campos_comunes',['object' => $categoria])
		@if(isset($padre))
			{!! Form::hidden('categoria_padre_id', $padre->id, array('class' => 'form-control')) !!}
		@endif
		<div class="form-group">
			{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>
