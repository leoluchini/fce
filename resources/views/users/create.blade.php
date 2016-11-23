@extends('layouts.app_back')

@section('content')
<div class="container">
    @include('generic.breadcrumb_multiple',['modulo' => 'Crear', 'enlaces' => array('Usuarios' => route('administracion.usuarios.index'))])
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          <h1>
            <span class="icon-edit"></span>
            Nuevo usuario
          </h1>
      </div>
    </div>
  </div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['route' => 'administracion.usuarios.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
			@include('users.form')
		{!! Form::close() !!}
	</div>
</div>

@endsection