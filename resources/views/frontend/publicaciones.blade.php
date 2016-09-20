@extends('layouts.app')

@include('layouts.header')

@section('content')
<div class="container">
  <div class="page-header">
    <div class="row">

      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-note-1"></span>
            Publicaciones
          </h2>
        </div>
      </div>

        </h4>
      </div>
    </div>
  </div>
  <div class="page-body">
  	<div class="row">
      	<div class="col-md-10 col-md-offset-1">

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
                      <tr>
                        <td>{{$publicacion->nombre}}</td>
                        <td>{{$publicacion->descripcion}}</td>
                        <td>{{$publicacion->anio_publicacion}}</td>
                        <td class="text-right">
                          <a href="{{ action('PublicacionController@ver_archivo', [$publicacion->id]) }}" target="_blank"><span class="icon-book-open pull-right"></span></a>
                          <a href="{{ action('PublicacionController@descargar_archivo', [$publicacion->id]) }}"><span class="icon-down-5 pull-right"></span></a>
                        </td>
                      </tr>
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
  </div>
</div>
@endsection