@extends('layouts.app_back')

@section('content')

<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => 'Variables de la categoría '.$categoria->nombre, 'enlaces' => array('&Aacute;rbol de variables' => action('CategoriaVariableController@index'))])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
          
          <div class="pull-right">
            <div class="btn-group">
            <h3>
              <a title="Nueva Variable" href="{{ action('VariableController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-level-down"></span></a>
            </h3>
            </div>
          </div>

          <h1>
            <span class="icon-flow-tree"></span>
              Variables de la categoría {{$categoria->nombre}}
          </h1>

      </div>
    </div>
  </div>

  <div class="col-xs-12">
		<div class="panel-group" role="tablist" aria-multiselectable="true">
		<ul class="list-group">
        @foreach($variables as $variable)
          <li class="list-group-item">
            <strong>{{ $variable->codigo }}</strong> - {{ $variable->nombre }}
            @if($variable->tema)
                <span class="label label-default" data-toggle="tooltip" data-placement="right" title="Variable madre">{{$variable->tema->nombre}}</span>
            @endif
            <div class="pull-right">
              <a title="Editar variable" href="{{ action('VariableController@edit', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top">
                <span class="icon-edit"></span>
              </a>

              <a title="Eliminar variable" href="{{ action('VariableController@destroy', [$categoria->id, $variable->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar variable" data-confirm="¿Estas seguro que desea eliminar la variable '{{$variable->nombre}}' ?">
                <span class="icon-trash-4"></span>
              </a>
            </div>
          </li>
      @endforeach
      </ul>
    </div>
    {{ $variables->render() }}
  </div>
</div>

@endsection