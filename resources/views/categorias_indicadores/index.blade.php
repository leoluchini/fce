@extends('layouts.app_back')

@section('content')

<div class="container">
    @include('generic.breadcrumb_simple',['modulo' => '&Aacute;rbol de indicadores'])
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          
          <div class="pull-right">
            <div class="btn-group">
              <h3>
              <a title="Nueva categoria" href="{{ action('CategoriaIndicadorController@create') }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>
              <a title="Indicadores agrupados" href="{{ action('IndicadorController@temas') }}" data-toggle="tooltip" data-placement="top"><span class="icon-list"></span></a>
              <a title="Busquedas sin resultados" href="{{ action('IndicadorController@busquedas') }}" data-toggle="tooltip" data-placement="top"><span class="icon-cancel-alt"></span></a>
          </h3>
            </div>
          </div>

          <h1>
            <span class="icon-flow-tree"></span>
              &Aacute;rbol de indicadores
          </h1>

      </div>
    </div>
  </div>

  <div class="col-xs-12">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="overflow:auto;">
		@foreach($categorias as $categoria)
				@include('categorias_indicadores.panel',['categoria' => $categoria, 'grupo' => 'accordion', 'nivel' => 1])
		@endforeach
    </div>
  </div>
</div>

@endsection