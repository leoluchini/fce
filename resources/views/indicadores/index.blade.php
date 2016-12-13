@extends('layouts.app_back')

@section('content')

<div class="container">
  @include('generic.breadcrumb_multiple',['modulo' => 'Indicadores de la categoría '.$categoria->nombre, 'enlaces' => array('&Aacute;rbol de indicadores' => action('CategoriaIndicadorController@index'))])
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
          
          <div class="pull-right">
            <div class="btn-group">
            <h3>
              <a title="Nuevo indicador" href="{{ action('IndicadorController@create', [$categoria->id]) }}" data-toggle="tooltip" data-placement="top"><span class="icon-level-down"></span></a>
            </h3>
            </div>
          </div>

          <h1>
            <span class="icon-flow-tree"></span>
              Indicadores de la categoría {{$categoria->nombre}}
          </h1>

      </div>
    </div>
  </div>

  <div class="col-xs-12">
		<div class="panel-group" role="tablist" aria-multiselectable="true">
		<ul class="list-group">
        @foreach($indicadores as $indicador)
          <li class="list-group-item">
            <strong>{{ $indicador->codigo }}</strong> - {{ $indicador->nombre }}
            @if($indicador->tema)
                <span class="label label-default" data-toggle="tooltip" data-placement="right" title="Indicador padre">{{$indicador->tema->nombre}}</span>
            @endif
            <div class="pull-right">
              <a title="Editar indicador" href="{{ action('IndicadorController@edit', [$categoria->id, $indicador->id]) }}" data-toggle="tooltip" data-placement="top">
                <span class="icon-edit"></span>
              </a>

              <a title="Eliminar indicador" href="{{ action('IndicadorController@destroy', [$categoria->id, $indicador->id]) }}" data-toggle="tooltip" data-placement="top" data-method="delete" data-title="Eliminar indicador" data-confirm="¿Estas seguro que desea eliminar el indicador '{{$indicador->nombre}}' ?">
                <span class="icon-trash-4"></span>
              </a>
            </div>
          </li>
      @endforeach
      </ul>
    </div>
    {{ $indicadores->render() }}
  </div>
</div>

@endsection