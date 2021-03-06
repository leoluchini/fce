@extends('layouts.app_back')

@section('content')
	<div class="container">
		@include('generic.breadcrumb_multiple',['modulo' => 'Nueva lectura', 'enlaces' => array('Subir indicadores' => action('LecturaIndicadorController@index'))])
	    <div class="row">
	      <div class="col-xs-12"> 
	        <div class="page-header">
	          <h1>
	            <span class="icon-upload"></span>
	            Nueva lectura
	          </h1>
	      </div>
	    </div>
	  </div>
			
		<center>
			{!! Form::open(['route' => 'administracion.lectura_indicador.store', 'files' => true]) !!}
				<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
	    		{{ Form::label('file', 'Archivo: ', ['class' => 'control-label']) }}
					{!! Form::file('file', null, [ 'class' => 'form-control']) !!}
					{!! $errors->first('file', '<p class="help-block">:message</p>') !!}
	  		</div>
				<div class="form-group">
						{!! Form::submit('Procesar', ['class' => 'btn btn-primary']) !!}
		  	</div>
	    {!! Form::close() !!}
			</center>

		</div>
	</div>


@endsection