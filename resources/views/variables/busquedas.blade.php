@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-1"> 
      <div class=" pull-left"> 
        <h4>
          <span class="glyphicon glyphicon-record"></span>
          Busquedas de variables sin resultados
        </h4>
      </div>
    </div>
     <div class="col-md-5">
      <h4 class="pull-right">
        <a title="Categorias" href="{{ action('CategoriaVariableController@index') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-triangle-left"></span></a>
      </h4>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="row">
    	<div class="col-md-8 col-md-offset-2"> 
        <div class="list-group">
          @foreach($busquedas as $busqueda)
            <a href="#" class="list-group-item active">{{$busqueda->busqueda}}</a>
          @endforeach
        </div>
		  </div>
	</div>
</div>
@endsection