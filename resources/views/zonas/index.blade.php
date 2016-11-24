@extends('layouts.app_back')

@section('content')
<div class="container">
  @include('generic.breadcrumb_simple',['modulo' => 'Territorios'])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="pull-right">
          <div class="btn-group">
            <h3>
               <a title="Nueva zona geografica" href="{{ action('ZonaGeograficaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="icon-plus"></span></a>
            </h3>
          </div>
        </div>

        <h1>
          <span class="icon-location-7"></span>
          Territorios
        </h1>

      </div>
    </div>
  </div>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="overflow:auto;">
    @foreach($zonas as $zona)
        @include('zonas.panel',['zona' => $zona, 'grupo' => 'accordion', 'nivel' => 1])
    @endforeach
    </div>

</div>

@endsection