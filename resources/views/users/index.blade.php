@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">

        <div class="pull-right">
          <div class="btn-group">
            <a href="{{ route('administracion.usuarios.create') }}" title="Nuevo usuario"  data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>

        <h1>
          <span class="icon-user-7"></span>
          Usuarios
        </h1>

      </div>
    </div>
  </div>
</div>


<div class="page-body">
  <div class="container">
    <div class="row">
      <div class="col-xs-12"> 
			<table class="tabla table-responsive table table-hover table-condensed">
			    <thead>
			        <tr>
                  <th><strong>Nombre</strong></p> </th>
                  <th><strong>Email</strong></p> </th>
                  <th><strong>Activo</strong></p> </th>
			            <th><strong>Administrador</strong></p> </th>
			            <th class="text-right"><p> <strong>Acciones</strong></p></th>
			        </tr>
			    </thead>
			    <tbody id="tabla-datos">
			     @foreach($users as $user)
              <tr>
                <td>{{ $user }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! boolean_html($user->active) !!}</td>
                <td>{!! boolean_html($user->is('admin')) !!}</td>
                <td class="text-right">
                  <a title="Editar usuario" href="{{ route('administracion.usuarios.edit', [$user->id]) }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-pencil"></span></a>
                  &nbsp;
                  <a title="Eliminar usuario" href="{{ route('administracion.usuarios.destroy', [$user->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar usuario" data-confirm="¿Estas seguro que desea eliminar a {{$user}} ?"><span class="glyphicon glyphicon-trash"></span></a>  
                </td>
              </tr>
            @endforeach
			    </tbody>
			</table>
		</div>
  </div>
	</div>
</div>
@endsection