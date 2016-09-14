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
              <input type="radio" name="tipo_busqueda" id="busqueda_option1" value="region_variable" autocomplete="off" checked> Region -> Variable
            </label>
            <label class="btn btn-default">
              <input type="radio" name="tipo_busqueda" id="busqueda_option2" value="variable_region" autocomplete="off"> Variable -> Region
            </label>
          </div>
        </div>
      </div>
    </div>
</div>



<div class="page-body">
    <section id="plan" class="full-section">
        <div class="container">
                <div id="accordion">
                  {!! Form::open(array('action' => ['PublicoController@resultados_variables'], 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                  <div id="panel-accordion-1" class="panel-accordion">
                    <div class="header" id="div_paso_1">
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
                            <input type="radio" name="tipo_zona" id="region_option1" value="pais" autocomplete="off" checked> Paises
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_zona" id="region_option2" value="provincia" autocomplete="off"> Provincias
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_zona" id="region_option3" value="municipio" autocomplete="off"> Municipios
                          </label>
                        </div>
                      </div>
                      <div id="div_pais" class="list-group list-plan">
                        <select 
                          id="pais" 
                          name="pais[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
                        </select>
                      </div>
                      <div id="div_provincia" class="list-group list-plan" style="display:none">
                        <select 
                          id="provincia" 
                          name="provincia[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
                        </select>
                      </div>
                      <div id="div_municipio" class="list-group list-plan" style="display:none">
                        <select 
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300">
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
                        <label id="var_reg" style="display:none">Las variables seleccionadas condicionarán las regiones del paso 2</label>
                        <label id="reg_var">Las variables estan condicionadas por las regiones seleccionadas en el paso 1</label>
                        <a class="btn btn-default btn-xs btn-menu" id="listo_seleccion" data-cerrar="1" style="display:none">
                          Cerrar Lista
                        </a>
                        <input type="text" 
                                class="form-control" 
                                id="variable" 
                                name="variable" 
                                value="" 
                                placeholder="Busque variables ingresando 3 o m&aacute;s caracteres" 
                                data-urlconsulta="{{action('PublicoController@consulta_variables')}}" 
                                data-token="{{ csrf_token() }}"
                                data-consultaregiones="{{action('PublicoController@consulta_regiones', [':query:'])}}" />
                      </div>
                      <div class="col-md-12" id="div_lista_tags">
                        <div class="mb-container">
                          <ul style="padding-left: 0px" id="lista_tags">
                          </ul>
                        </div>
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
                            <input type="radio" name="tipo_frecuencia" id="frecuencia_option1" value="anual" autocomplete="off" checked> Anual
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="frecuencia_option2" value="semestral" autocomplete="off"> Semestral
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="frecuencia_option3" value="trimestral" autocomplete="off"> Trimestral
                          </label>
                          <label class="btn btn-default">
                            <input type="radio" name="tipo_frecuencia" id="frecuencia_option4" value="mensual" autocomplete="off"> Mensual
                          </label>
                        </div>
                        <div class="col-md-2 col-md-offset-10">
                        {!! Form::submit('Buscar', array('class' => 'btn btn-primary btn-block')) !!}
                        </div>
                      </div>
                      <div class="list-group list-plan">
                        <div id="div_semestral" class="list-plan" style="display:none">
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
                        <div id="div_trimestral" class="list-plan" style="display:none">
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
                        <div id="div_mensual" class="list-plan" style="display:none">
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
                  </div>
                  {!! Form::close() !!}
          </div>

      </div>
    </section>


</div>
<style>
  .image_background_loading{
    background: white url("{{ asset('images/ajax-loader.gif') }}") right no-repeat;
  }
</style>
<script type="text/html" id="agregar_variable">
  <li style="opacity: 1; list-style-type: none" data-tag="">
    <span class="texto"></span>
    <input type="hidden" value="" name="">
    <a class="mb-tag-remove pull-right"><span class="glyphicon glyphicon-remove-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar"></span> </a>
  </li>
</script>
<script type="text/html" id="listado_paises">
  @foreach($paises as $zona)
    <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
  @endforeach
</script>
<script type="text/html" id="listado_provincias">
  @foreach($provincias as $zona)
    <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
  @endforeach
</script>
<script type="text/html" id="listado_municipios">
  @foreach($municipios as $zona)
    <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
  @endforeach
</script>
@endsection
@section('scripts_adicionales')
    <script src="{{ asset('js/filtros_variables.js') }}"></script>
    <link href="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.css') }}" rel="stylesheet">
    <script src="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.js') }}"></script>
@endsection