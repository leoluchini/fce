@extends('layouts.app_back')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          <h1>
            <span class="icon-th-list-2"></span>
            Listado de variables
          </h1>
          <h4 class="pull-right">
            <a title="Nueva categoria" href="{{ action('CategoriaVariableController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
            <a title="Variables agrupadas" href="{{ action('CategoriaVariableController@temas') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-list-alt"></span></a>
          </h4>
      </div>
    </div>
  </div>
</div>




<div class="page-body">
	<div class="container">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		@foreach($categorias as $categoria)
				@include('categorias_variables.panel',['categoria' => $categoria, 'grupo' => 'accordion', 'nivel' => 1])
		@endforeach
	  </div>
	</div>
</div>
@endsection