@extends('layouts.app_back')

<div class="col-xs-12 header_frontend">
  <div class="row">
    <div class="col-xs-6 row">
      <div class="icon_menu">
        <a href="{{action('AdministracionController@index')}}"><span class="icon-book pull-left" id='hideshow'></span></a>
      </div>
      <div class="header_izquierda">
        <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
         {!! Html::image('images/menu_horizontal_LAB.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>''])!!}
        </a>
        <a href="http://www.econo.unlp.edu.ar" target="_blank" class="border_left">
          {!! Html::image('images/menu_horizontal_FCE.png', 'Facultad de Ciencias Econ&oacute;micas', ['class'=>''])!!}
        </a>
      </div>
    </div>

    <div class="col-xs-6 row pull-right">
      <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
       {!! Html::image('images/menu_horizontal_UNLP.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>'pull-right'])!!}
      </a>
    </div>
  </div>
</div>

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
  	<div class="row">
      	<div class="col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-4">
              <a href="{{action('LecturaController@index')}}" class="text-right"><span class="icon-info"></span>Subir Informacion de Variables</a>
            </div>
            <div class="col-md-4">
              <a href="{{action('CategoriaVariableController@index')}}" class="text-right"><span class="icon-tree"></span>Arbol de Variables</a>
            </div>
            <div class="col-md-4">
              <a href="{{action('CategoriaController@index')}}" class="text-right"><span class="icon-note-1"></span>Categorias y Publicaciones</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <a href="{{action('FrecuenciaController@index')}}" class="text-right"><span class="icon-note-1"></span>Frecuencias</a>
            </div>
            <div class="col-md-4">
              <a href="{{action('FuenteController@index')}}" class="text-right"><span class="icon-note-1"></span>Fuentes</a>
            </div>
            <div class="col-md-4">
              <a href="{{action('UnidadController@index')}}" class="text-right"><span class="icon-note-1"></span>Unidades</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <a href="{{action('ZonaGeograficaController@index')}}" class="text-right"><span class="icon-note-1"></span>Zonas Geograficas</a>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
@endsection