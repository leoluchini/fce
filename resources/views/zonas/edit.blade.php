@extends('layouts.app_back')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          @include('generic.breadcrumb_multiple',['modulo' => 'Editar', 'enlaces' => array('Territorios' => action('ZonaGeograficaController@index'))])
          <h1>
            <span class="icon-edit"></span>
            Edici&oacute;n de territorio
          </h1>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="container">
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
	</div>
</div>
@endsection
@section('scripts_adicionales')
<script src="{{ asset('js/zonas_geograficas.js') }}"></script>
@endsection