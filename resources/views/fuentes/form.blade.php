<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>{{$titulo}}</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($fuente, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		<div class="form-group @if ($errors->first('codigo')){!! 'has-error' !!}@endif">
			{!! Form::label('sigla', '*Sigla', array('class' => 'control-label')) !!}
			{!! Form::text('sigla', $fuente->sigla, array('class' => 'form-control')) !!}
			@if ($errors->first('sigla'))<span class="help-block">{{$errors->first('sigla')}}</span>@endif
		</div>
		<div class="form-group @if ($errors->first('nombre')){!! 'has-error' !!}@endif">
			{!! Form::label('nombre', '*Nombre', array('class' => 'control-label')) !!}
			{!! Form::text('nombre', $fuente->nombre, array('class' => 'form-control')) !!}
			@if ($errors->first('nombre'))<span class="help-block">{{$errors->first('nombre')}}</span>@endif
		</div>
		<div class="form-group @if ($errors->first('descripcion')){!! 'has-error' !!}@endif">
			{!! Form::label('descripcion', '*Descripcion', array('class' => 'control-label')) !!}
			{!! Form::textarea('descripcion', $fuente->descripcion, array('class' => 'form-control')) !!} 
			@if ($errors->first('descripcion'))<span class="help-block">{{$errors->first('descripcion')}}</span>@endif
		</div>
		<div class="form-group">
			{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>