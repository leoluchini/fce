@extends('layouts.app_back')

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<h3>
			<span>Editar usuario</span>
		</h3>
		
	</div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::model($user, ['route' => [ 'administracion.usuarios.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
			@include('users.form')
		{!! Form::close() !!}
</div>
@endsection