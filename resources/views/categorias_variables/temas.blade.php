@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5 col-md-offset-1"> 
      <div class=" pull-left"> 
        <h4>
          <span class="glyphicon glyphicon-record"></span>
          Listado de Variables agrupados por Variable Madre
        </h4>
      </div>
    </div>
     <div class="col-md-5">
      <h4 class="pull-right">
        <a title="Categorias" href="{{ action('CategoriaVariableController@index') }}" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-triangle-left"></span></a>
      </h4>
    </div>
  </div>
</div>
<div class="page-body">
	<div class="row">
    	<div class="col-md-10 col-md-offset-1"> 
    		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          @foreach($temas as $tema)
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading{{$tema->id}}">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$tema->id}}" aria-expanded="true" aria-controls="collapse{{$tema->id}}">
                    {{$tema->nombre}}
                  </a>
                </h4>
              </div>
              <div id="collapse{{$tema->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$tema->id}}">
                <div class="panel-body">
                  <ul class="list-group">
                    @foreach($tema->variables as $variable)
                      <li class="list-group-item">{{$variable->nombre}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
        </div>
		</div>
	</div>
</div>
@endsection