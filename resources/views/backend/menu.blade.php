@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="page-header">
    <div class="row">

      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-list"></span>
            Modulos
          </h2>
        </div>
      </div>

        </h4>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('LecturaController@index')}}">
              <h2><span class="icon-upload"></span></h2>
              <h3>Subir Informacion de Variables</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('CategoriaVariableController@index')}}">
              <h2><span class="icon-share-squared"></span></h2>
              <h3>Arbol de Variables</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
              <h2><span class="icon-upload-cloud"></span></h2>
              <h3>Subir Informacion de Indicadores</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="#">
              <h2><span class="icon-th"></span></h2>
              <h3>Arbol de Indicadores</h3>
            </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('FrecuenciaController@index')}}">
              <h2><span class="icon-calendar"></span></h2>
              <h3>Frecuencias</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('FuenteController@index')}}">
              <h2><span class="icon-archive"></span></h2>
              <h3>Fuentes</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('UnidadController@index')}}">
              <h2><span class="icon-temperatire"></span></h2>
              <h3>Unidades</h3>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('ZonaGeograficaController@index')}}">
              <h2><span class="icon-globe"></span></h2>
              <h3>Zonas Geograficas</h3>
            </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('CategoriaController@index')}}">
              <h2><span class="icon-newspaper"></span></h2>
              <h3>Categorias y Publicaciones</h3>
            </a>
        </div>
        @role('admin')
          <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="{{action('UserController@index')}}">
                <h2><span class="icon-newspaper"></span></h2>
                <h3>Usuarios</h3>
              </a>
          </div>
        @endrole
      </div>
    </div>
  </div>
</div>
</div>
@endsection