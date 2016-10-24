@extends('layouts.app_back')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          
          <div class="pull-right">
            <div class="btn-group">
            <a title="Nueva categoria" href="{{ action('CategoriaVariableController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
            <a title="Variables agrupadas" href="{{ action('VariableController@temas') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-list-alt"></span></a>
            <a title="Busquedas sin resultados" href="{{ action('VariableController@busquedas') }}" data-toggle="tooltip" data-placement="top"><span class="icon-binoculars"></span></a>
            </div>
          </div>

          <h1>
            <span class="icon-flow-tree"></span>
              &Aacute;rbol de variables
          </h1>

      </div>
    </div>
  </div>
</div>



<div class="page-body">
	<div class="container">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="overflow:auto;">
		@foreach($categorias as $categoria)
				@include('categorias_variables.panel',['categoria' => $categoria, 'grupo' => 'accordion', 'nivel' => 1])
		@endforeach
	  </div>
	</div>
</div>
@endsection