@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => 'Lote', 'enlaces' => array('Subir indicadores' => action('LecturaIndicadorController@index'))])
  <div class="row">
    <div class="col-xs-12"> 
    </div>
    <div class="col-xs-12">
			@include('lectura_indicadores.navs')
    </div>
  </div>
</div>
@endsection