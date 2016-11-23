@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => 'Busquedas', 'enlaces' => array('&Aacute;rbol de indicadores' => action('CategoriaIndicadorController@index'))])
  <div class="row">
    <div class="col-xs-12">
      <div class="page-header">
        <h1>
          <span class="icon-flow-tree"></span>
          B&uacute;squedas de indicadores sin resultados
        </h1>
      </div>
    </div>
  </div>

  <div class="col-xs-12">
    <div class="list-group" style="overflow:auto;max-height:380px">
      @foreach($busquedas as $busqueda)
        <a href="#" class="list-group-item active">{{$busqueda->busqueda}}</a>
      @endforeach
    </div>
  </div>
</div>
@endsection