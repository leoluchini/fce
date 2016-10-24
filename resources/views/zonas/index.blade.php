@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">

        <div class="pull-right">
          <div class="btn-group">
             <a title="Nueva zona geografica" href="{{ action('ZonaGeograficaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </div>
        </div>

        <h1>
          <span class="icon-location-7"></span>
          Territorios
        </h1>

      </div>
    </div>
  </div>
</div>



<div class="page-body">

  <div class="container">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach($zonas as $zona)
        @include('zonas.panel',['zona' => $zona, 'grupo' => 'accordion', 'nivel' => 1])
    @endforeach
    </div>
  </div>

</div>
@endsection