@extends('layouts.app_back')

@section('content')
	<div class="container">
	    <div class="row">
	      <div class="col-xs-12"> 
	        <div class="page-header">
	          @include('generic.breadcrumb_multiple',['modulo' => 'Editar', 'enlaces' => array('Usuarios' => route('administracion.usuarios.index'))])
	          <h3>
	            <span class="icon-edit"></span>
	            Editar usuario
	          </h3>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="page-body">
		<div class="container">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($user, ['route' => [ 'administracion.usuarios.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
					@include('users.form')
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection