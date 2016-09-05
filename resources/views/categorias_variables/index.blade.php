@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-1"> 
      <div class=" pull-left"> 
        <h4>
          <span class="glyphicon glyphicon-record"></span>
          Listado de Categorias de Variables
        </h4>
      </div>
    </div>
     <div class="col-md-5">
      <h4 class="pull-right">
        <a title="Nueva categoria" href="{{ action('CategoriaVariableController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
      </h4>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="row">
    	<div class="col-md-10 col-md-offset-1"> 
    		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				@foreach($categorias as $categoria)
					@if($categoria->categoria_padre == null)
						@include('categorias_variables.panel',['categoria' => $categoria, 'grupo' => 'accordion'])
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection