<div class="col-md-12">
	<div class="form-group @if ($errors->first('name')){!! 'has-error' !!}@endif">
		{!! Form::label('name', '*Nombre completo', array('class' => 'control-label')) !!}
		{!! Form::text('name', null, array('class' => 'form-control')) !!}
		@if ($errors->first('name'))<span class="help-block">{{$errors->first('name')}}</span>@endif
	</div>
	<div class="form-group @if ($errors->first('email')){!! 'has-error' !!}@endif">
		{!! Form::label('email', '*Email', array('class' => 'control-label')) !!}
		{!! Form::text('email', null, array('class' => 'form-control')) !!}
		@if ($errors->first('email'))<span class="help-block">{{$errors->first('email')}}</span>@endif
	</div>
	<div class="form-group">
		{!! Form::label('roles', 'Rol', array('class' => 'control-label')) !!}
		{!! Form::select('roles',$roles,null, array('placeholder'=>'','class' => 'form-control')) !!}
	</div>
@if( !isset($user))
	<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', '*Contrase&ntilde;a', array('class' => 'control-label')) !!}
		{!! Form::password('password', array('class' => 'form-control')) !!}
    @if ($errors->has('password'))
      <span class="help-block">{{ $errors->first('password') }}</strong>
    @endif
  </div>

	<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
		{!! Form::label('password_confirmation', '*Confirmaci&oacute;n Contrase&ntilde;a', array('class' => 'control-label')) !!}
		{!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
    @if ($errors->has('password_confirmation'))
      <span class="help-block">{{ $errors->first('password_confirmation') }}</strong>
    @endif
	</div>
@endif
	<div class="form-group">
		{!! Form::submit('Guardar', array('class' => 'btn btn-primary btn-block')) !!}
		<a href="{{ route('administracion.usuarios.index') }}" class="btn btn-default btn-block">Cancelar</a>
	</div>
</div>
