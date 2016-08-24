@extends('layouts.app')

@section('content')
<div class="col-md-10 col-md-offset-1">
	<h3>
		<span>Edicion de zona geografica</span>
	</h3>
	
</div>

<div class="col-md-8 col-md-offset-2">
	{!! Form::model($zona, array('action' => ['ZonaGeograficaController@update', $zona->id], 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}
	<div class="col-md-12">
		@include('generic.campos_comunes',['object' => $zona])
		{!! Form::hidden('tipo', $zona->tipo, array('class' => 'form-control')) !!}
		@if ($zona->tipo != 'pais')
			<div class="form-group @if ($errors->first('zona_padre_id')){!! 'has-error' !!}@endif">
				{!! Form::label('zona_padre_id', '*Pertenece a', array('class' => 'control-label')) !!}
				{!! Form::select('zona_padre_id', $padres, $zona->zona_padre_id, array('class' => 'form-control')) !!}
				@if ($errors->first('zona_padre_id'))<span class="help-block">{{$errors->first('zona_padre_id')}}</span>@endif
			</div>
		@endif
		<div class="form-group">
			{!! Form::submit('Guardar', array('class' => 'btn btn-primary btn-block')) !!}
			<a href="{{ action('ZonaGeograficaController@index') }}" class="btn btn-default btn-block">Cancelar</a>
		</div>

	</div>
	{!! Form::close() !!}
</div>
@endsection
@section('scripts_adicionales')
<script src="{{ asset('js/zonas_geograficas.js') }}"></script>
@endsection