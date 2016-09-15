@extends('layouts.app_back')

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<h3>
			<span>Nuevo usuario</span>
		</h3>
		
	</div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['route' => 'administracion.usuarios.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
			@include('users.form')
		{!! Form::close() !!}
</div>
@endsection