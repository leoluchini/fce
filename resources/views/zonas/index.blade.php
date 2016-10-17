@extends('layouts.app_back')

@section('content')

<div class="container">
  <div class="page-header">
    <div class="row">
      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-box-2"></span>
            Territorios
          </h2>
        </div>
        <div class="pull-right">
          <h4>
        <a title="Nueva zona geografica" href="{{ action('ZonaGeograficaController@create') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-plus"></span></a>
          </h4>
        </div>
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