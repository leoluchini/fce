@extends('layouts.app')

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<h3>
			<span>Nueva lectura</span>
		</h3>
	</div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['route' => 'lectura.store', 'files' => true]) !!}
			<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
    		{{ Form::label('file', 'Archivo: ', ['class' => 'control-label']) }}
				{!! Form::file('file', null, [ 'class' => 'form-control']) !!}
				{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
  		</div>
		</div>
		<div class="form-group">
    	<div class="col-sm-offset-2 col-sm-10">
				{!! Form::submit('Procesar', ['class' => 'btn btn-primary']) !!}
    	</div>
  	</div>
    {!! Form::close() !!}
	</div>

@endsection