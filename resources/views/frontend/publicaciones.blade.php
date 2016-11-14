@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="page-header">
        <div class="row">
        <div class="col-md-6">
          <h1>
            <span class="icon-note-1"></span>
            Publicaciones
          </h1>
        </div>
        <div class="col-md-6">
          {!! Form::open(array('action' => ['FrontendPublicacionesController@publicaciones'], 'method' => 'POST', "class" => "form-inline")) !!}
          <div class="col-xs-12 buscador">
            <div class="pull-right"> 
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon" id="sizing-addon3"><span class="icon-search-8"></span> </span>
                  <input name="busqueda" type="text" class="form-control" placeholder="Busqueda" aria-describedby="sizing-addon3" value="{{(isset($filtros['busqueda']) && ($filtros['busqueda'] != '')) ? $filtros['busqueda'] : '' }}">
                </div>    
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <select name="anio" class="form-control form-control-sm">
                    @foreach($anios as $key => $value)
                      <?php $selected = isset($filtros['anio']) ? (($key == $filtros['anio']) ? 'selected' : '') : '' ?>
                      <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
      </div>
    </div>
  </div>

  	<div class="row">
      	<div class="col-md-12">

          <ul class="nav nav-tabs nav-justified" role="tablist">
            <?php $tab_status = 'class="active"' ?>
            @foreach($categorias as $categoria)
              <li role="presentation" {{ $tab_status }}>
                <a href="#publicaciones_{{$categoria->id}}" aria-controls="publicaciones_{{$categoria->id}}" role="tab" data-toggle="tab">{{$categoria->nombre}}</a>
              </li>
              <?php $tab_status = '' ?>
            @endforeach
          </ul>
          <div class="tab-content">
            <?php $panel_status = 'active' ?>
            @foreach($categorias as $categoria)
            <div role="tabpanel" class="tab-pane {{$panel_status}}" id="publicaciones_{{$categoria->id}}">
              <table class="tabla table-responsive table table-hover table-condensed">
                  <thead>
                      <tr>
                          <th><strong>Nombre</strong></p> </th>
                          <th><strong>Descripcion</strong></p> </th>
                          <th><strong>Año</strong></p> </th>
                          <th class="text-right"><p> <strong>Acciones</strong></p></th>
                      </tr>
                  </thead>
                  <tbody id="tabla-datos">
                      @foreach($categoria->publicaciones as $publicacion)
                        @if(isset($filtros['regex']) || isset($filtros['anio']))
                          @if(  ((isset($filtros['regex']) && ($filtros['anio'] != ''))
                                && (preg_match($filtros['regex'], $publicacion->nombre) || preg_match($filtros['regex'], $publicacion->palabras_clave))
                                && ($publicacion->anio_publicacion == $filtros['anio']))
                              ||
                                ((isset($filtros['regex']) && ($filtros['anio'] == ''))
                                && (preg_match($filtros['regex'], $publicacion->nombre) || preg_match($filtros['regex'], $publicacion->palabras_clave)))
                              ||
                                ((!isset($filtros['regex']) && ($filtros['anio'] != ''))
                                && ($publicacion->anio_publicacion == $filtros['anio']))
                              )
                            <tr>
                              <td>{{$publicacion->nombre}}</td>
                              <td>{{$publicacion->descripcion}}</td>
                              <td>{{$publicacion->anio_publicacion}}</td>
                              <td class="text-right">
                                <a href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" target="_blank"><span class="icon-book-open pull-right"></span></a>
                                <a href="{{ action('PublicacionController@descargar_archivo', [$publicacion->id]) }}"><span class="icon-down-5 pull-right"></span></a>
                              </td>
                            </tr>
                          @endif
                        @else
                          <tr>
                            <td>{{$publicacion->nombre}}</td>
                            <td>{{$publicacion->descripcion}}</td>
                            <td>{{$publicacion->anio_publicacion}}</td>
                            <td class="text-right">
                              <a href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" target="_blank"><span class="icon-book-open pull-right"></span></a>
                              <a href="{{ action('PublicacionController@descargar_archivo', [$publicacion->id]) }}"><span class="icon-down-5 pull-right"></span></a>
                            </td>
                          </tr>
                        @endif
                      @endforeach
                  </tbody>
              </table>
            </div>
            <?php $panel_status = '' ?>
            @endforeach
          </div>
      </div>
    </div>


    </div>

@endsection