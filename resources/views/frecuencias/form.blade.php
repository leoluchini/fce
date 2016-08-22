<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>{{$titulo}}</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($frecuencia, array('action' => $accion, 'method' => $metodo, 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		<div class="form-group @if ($errors->first('codigo')){!! 'has-error' !!}@endif">
			{!! Form::label('tipo', '*Tipo', array('class' => 'control-label')) !!}
			{!! Form::select('tipo', $tipos_frecuencias, $frecuencia->tipo, array('class' => 'form-control')) !!}
			@if ($errors->first('tipo'))<span class="help-block">{{$errors->first('codigo')}}</span>@endif
		</div>
		<div class="form-group @if ($errors->first('codigo')){!! 'has-error' !!}@endif">
			{!! Form::label('codigo', '*Codigo', array('class' => 'control-label')) !!}
			{!! Form::text('codigo', $frecuencia->codigo, array('class' => 'form-control')) !!}
			@if ($errors->first('codigo'))<span class="help-block">{{$errors->first('codigo')}}</span>@endif
		</div>
		<div class="form-group @if ($errors->first('nombre')){!! 'has-error' !!}@endif">
			{!! Form::label('nombre', '*Nombre', array('class' => 'control-label')) !!}
			{!! Form::text('nombre', $frecuencia->nombre, array('class' => 'form-control')) !!}
			@if ($errors->first('nombre'))<span class="help-block">{{$errors->first('nombre')}}</span>@endif
		</div>
		<div class="form-group">
			{!! Form::submit($boton, array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ $cancelar }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>
