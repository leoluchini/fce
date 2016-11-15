@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12">  
      <div class="page-header">
        @include('generic.breadcrumb_multiple',['modulo' => 'Indicadores padre', 'enlaces' => array('&Aacute;rbol de indicadores' => action('CategoriaIndicadorController@index'))])
        <h1>
          <span class="icon-flow-tree"></span>
          Listado de indicadores agrupadas por Indicador Padre
        </h1>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container">
      <div class="col-xs-12">
    		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="overflow:auto">
          @foreach($temas as $tema)
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading{{$tema->id}}">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$tema->id}}" aria-expanded="true" aria-controls="collapse{{$tema->id}}">
                    <p class="blanco">{{$tema->nombre}}</p>
                  </a>
                </h4>
              </div>
              <div id="collapse{{$tema->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$tema->id}}">
                <div class="panel-body">
                  <ul class="list-group">
                    @foreach($tema->indicadores as $indicador)
                      <li class="list-group-item">{{$indicador->nombre}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
          <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingSintema">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSintema" aria-expanded="true" aria-controls="collapseSintema">
                    <p class="blanco">Otros (sin indicador padre)</p>
                  </a>
                </h4>
              </div>
              <div id="collapseSintema" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSintema">
                <div class="panel-body">
                  <ul class="list-group">
                    @foreach($indicadores as $indicador)
                      <li class="list-group-item">{{$indicador->nombre}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
        </div>
		</div>
	</div>
</div>
@endsection