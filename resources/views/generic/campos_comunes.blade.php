<div class="form-group @if ($errors->first('codigo')){!! 'has-error' !!}@endif">
	{!! Form::label('codigo', '*Código', array('class' => 'control-label')) !!}
	{!! Form::text('codigo', ($object != null ? $object->codigo : ''), array('class' => 'form-control')) !!}
	@if ($errors->first('codigo'))<span class="help-block">{{$errors->first('codigo')}}</span>@endif
</div>
<div class="form-group @if ($errors->first('nombre')){!! 'has-error' !!}@endif">
	{!! Form::label('nombre', '*Nombre', array('class' => 'control-label')) !!}
	{!! Form::text('nombre', ($object != null ? $object->nombre : ''), array('class' => 'form-control')) !!}
	@if ($errors->first('nombre'))<span class="help-block">{{$errors->first('nombre')}}</span>@endif
</div>
<div class="form-group @if ($errors->first('descripcion')){!! 'has-error' !!}@endif">
	{!! Form::label('descripcion', '*Descripción', array('class' => 'control-label')) !!}
	{!! Form::textarea('descripcion', ($object != null ? $object->descripcion : ''), array('class' => 'form-control')) !!} 
	@if ($errors->first('descripcion'))<span class="help-block">{{$errors->first('descripcion')}}</span>@endif
</div>