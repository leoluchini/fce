@extends('layouts.app_back')

@section('content')
<div class="container">
  <div class="page-header">
    <div class="row">
      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-box-2"></span>
            M&oacute;dulos
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('LecturaController@index')}}">
              <h2><span class="icon-upload-cloud-outline"></span></h2>
              <h4>Subir variables</h4>
            </a>
          </center>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('CategoriaVariableController@index')}}">
              <h2><span class="icon-flow-tree"></span></h2>
              <h4>&Aacute;rbol de variables</h4>
            </a>
          </center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="#">
              <h2><span class="icon-upload-cloud"></span></h2>
              <h4>Subir indicadores</h4>
            </a>
          </center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="#">
              <h2><span class="icon-flow-tree "></span></h2>
              <h4>&Aacute;rbol de indicadores</h4>
            </a>
          </center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('FrecuenciaController@index')}}">
              <h2><span class="icon-calendar-8"></span></h2>
              <h4>Frecuencias</h4>
            </a>
          </center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('FuenteController@index')}}">
              <h2><span class="icon-archive"></span></h2>
              <h4>Fuentes</h4>
            </a>
          </center>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('UnidadController@index')}}">
              <h2><span class="icon-ruler"></span></h2>
              <h4>Unidades</h4>
            </center>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('ZonaGeograficaController@index')}}">
              <h2><span class="icon-location-7"></span></h2>
              <h4>Territorios</h4>
            </a>
          </center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <center>
            <a href="{{action('CategoriaController@index')}}">
              <h2><span class="icon-newspaper"></span></h2>
              <h4>Categorias y Publicaciones</h4>
            </a>
          </center>
        </div>
        @role('admin')
          <div class="col-md-3 col-sm-6 col-xs-12">
            <center>
              <a href="{{action('UserController@index')}}">
                <h2><span class="icon-user-6"></span></h2>
                <h4>Usuarios</h4>
              </a>
            </center>
          </div>
        @endrole
      </div>
    </div>
  </div>
</div>
</div>
@endsection