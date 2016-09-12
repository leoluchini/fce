@extends('layouts.app')

<div class="col-xs-12 header_frontend">
  <div class="row">
    <div class="col-xs-6 row">

      <div class="icon_menu">
        <span class="icon-menu pull-left" id='hideshow'></span>
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
            <span class="icon-th-list-2"></span>
            Variables
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="list-group list-plan">
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active">
              <input type="radio" name="tipo_busqueda" id="option1" value="region_variable" autocomplete="off" checked> Region -> Variable
            </label>
            <label class="btn btn-default">
              <input type="radio" name="tipo_busqueda" id="option2" value="variable_region" autocomplete="off"> Variable -> Region
            </label>
          </div>
        </div>
      </div>
    </div>
</div>



<div class="page-body">
  <!-- Plan Section -->
    <section id="plan" class="full-section">
        <div class="container">
            <!-- <ol class="breadcrumb">Soy </ol> -->

                <div id="accordion">
                  {!! Form::open(array('action' => ['PublicoController@resultados_variables'], 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                  <div id="panel-accordion-1" class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">1</p>
                    </div>
                    <div class="panelContent">
                      <p class="titulos_accordion">Región</p>
                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default active">
                            <input type="radio" name="tipo_zona" id="option1" value="pais" autocomplete="off" checked> Paises
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_zona" id="option2" value="provincia" autocomplete="off"> Provincias
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_zona" id="option3" value="municipio" autocomplete="off"> Municipios
                          </label>
                        </div>
                      </div>
                      <div id="pais" class="list-group list-plan">
                        <select 
                          id="pais" 
                          name="pais[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($paises as $zona)
                              <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div id="provincia" class="list-group list-plan" style="display:none">
                        <select 
                          id="provincia" 
                          name="provincia[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($provincias as $zona)
                              <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div id="municipio" class="list-group list-plan" style="display:none">
                        <select 
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($municipios as $zona)
                              <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>


                  <div  id="panel-accordion-2" class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">2</p>
                    </div>
                    <div class="panelContent"> 
                      <p class="titulos_accordion">Variables</p>
                       <div class="list-group list-plan">
                        <select 
                          id="variable" 
                          name="variable[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-nonselectedsext="Escoja las variables que le interesen"
                          data-allselectedtext="Todas las variables escogidas"
                          data-nselectedtext=" varibles escogidas" 
                          data-height="300"
                          data-maxheight="300">
                          @foreach($variables as $variable)
                            <option value="{{$variable->id}}" >{{$variable->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>


                  <div  id="panel-accordion-3" class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">3</p>
                    </div>
                    <div class="panelContent">
                      <p class="titulos_accordion">Período</p>
                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <select 
                          id="periodo" 
                          name="periodo[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-nonselectedsext="Escoja el período que le interese"
                          data-allselectedtext="Todas las variables escogidas"
                          data-nselectedtext=" varibles escogidas" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($periodos as $periodo)
                              <option value="{{$periodo}}" >{{$periodo}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">4</p>
                    </div>
                    <div class="panelContent">
                      <p class="titulos_accordion">Frecuencia</p>
                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default active">
                            <input type="radio" name="tipo_frecuencia" id="option1" value="anual" autocomplete="off" checked> Anual
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="option2" value="semestral" autocomplete="off"> Semestral
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="option3" value="trimestral" autocomplete="off"> Trimestral
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="option4" value="mensual" autocomplete="off"> Mensual
                          </label>
                        </div>
                        <div class="col-md-2 col-md-offset-10">
                        {!! Form::submit('Buscar', array('class' => 'btn btn-primary btn-block')) !!}
                        </div>
                      </div>

                      <div id="semestral" class="list-plan" style="display:none">
                        <select 
                          id="semestral" 
                          name="semestral[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold_simple" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($semestres as $periodo)
                              <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div id="trimestral" class="list-plan" style="display:none">
                        <select 
                          id="trimestral" 
                          name="trimestral[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold_simple" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($trimestres as $periodo)
                              <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div id="mensual" class="list-plan" style="display:none">
                        <select 
                          id="mensual" 
                          name="mensual[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold_simple" 
                          data-height="300"
                          data-maxheight="300">
                            @foreach($meses as $periodo)
                              <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  {!! Form::close() !!}
          </div>

      </div>
    </section>


</div>

@endsection
@section('scripts_adicionales')
    <script src="{{ asset('js/filtros_variables.js') }}"></script>
@endsection