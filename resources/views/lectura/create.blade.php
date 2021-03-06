@extends('layouts.app_back')

@section('content')
	<div class="container">
	@include('generic.breadcrumb_multiple',['modulo' => 'Nueva lectura', 'enlaces' => array('Subir variables' => action('LecturaController@index'))])
	    <div class="row">
	      <div class="col-xs-12"> 
	        <div class="page-header">
	          <h1>
	            <span class="icon-upload-outline"></span>
	            Nueva lectura
	          </h1>
	      </div>
	    </div>
	  </div>
	
		<div class="col-md-8 col-md-offset-2">
			{!! Form::open(['route' => 'administracion.lectura.store', 'files' => true]) !!}
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
	</div>

@endsection