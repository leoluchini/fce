@extends('layouts.app')

@include('layouts.header')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          <h1>
            <span class="icon-th-list-2"></span>
            Variables
          </h1>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        
        <div class="list-group list-plan">
          <div data-toggle="buttons">
            <h4>Realizar búsqueda por
              <!--<label>
                <input type="radio" id="busqueda_option1" name="tipo_busqueda" value="region_variable"/>
              </label> -->
              <button  class="btn btn-none active">
                <input type="radio" name="tipo_busqueda" id="busqueda_option1" value="region_variable" autocomplete="off" checked>
                <h4 class="azul_FCE"><span class="icon-check-1"></span>Territorio</h4>
              </button>
              o por
              <button class="btn btn-none">
                <input type="radio" name="tipo_busqueda" id="busqueda_option2" value="variable_region" autocomplete="off">
                <h4 class="azul_FCE_apagado"><span class="icon-check-empty"></span>Variable</h4>
              </button>
            </h4>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <section id="plan" class="full-section">
        <div class="container">
              {!! Form::open(array('action' => ['PublicoController@resultados_variables'], 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                <div id="accordion">
                  <div id="panel-accordion-1" class="panel-accordion">
<!-- TERRITORIO-->
                    <div class="header" id="div_paso_1">
                      <div  class="texto-vertical-2">PASO 1</div>
                    </div>

                    <div class="panelContent">
                      <h3 class="titulos_accordion">Territorio</h3>
                      <hr>

                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <ul class="nav nav-tabs nav-justified altura" role="tablist">
                          <li role="presentation" class="solapa_zona active" data-region="pais">
                            <a href="#div_pais" role="tab" data-toggle="tab" aria-controls="div_pais">Países</a>
                            
                          </li>
                          <li role="presentation" class="solapa_zona" data-region="provincia">
                            <a href="#div_provincia" role="tab" data-toggle="tab" aria-controls="div_provincia">Provincias</a>
                          </li>
                          <li role="presentation" class="solapa_zona" data-region="municipio">
                            <a href="#div_municipio" role="tab" data-toggle="tab" aria-controls="div_municipio">Municipios</a>
                          </li>
                      </ul>
                      <input type="hidden" id="tipo_zona" name="tipo_zona" value="pais">
                      <div class="tab-content">
                         <div id="div_pais" role="tabpanel" class="tab-pane active" >
                            <select 
                              id="pais" 
                              name="pais[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold" 
                              data-height="300"
                              data-maxheight="300">
                            </select>
                          </div>
                          <div id="div_provincia" role="tabpanel" class="tab-pane">
                           <select 
                              id="provincia" 
                              name="provincia[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold" 
                              data-height="300"
                              data-maxheight="300">
                            </select>
                          </div>
                          <div id="div_municipio"role="tabpanel" class="tab-pane">
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
                  </div>
                     

<!-- VARIABLES -->

                  <div  id="panel-accordion-2" class="panel-accordion">
                    <div class="header">
                      <div  class="texto-vertical-2">PASO 2</div>
                    </div>
                    <div class="panelContent"> 
                      <h3 class="titulos_accordion">Variables</h3>
                      <hr>

                       <div class="list-group list-plan">
                        <label id="var_reg" style="display:none">Las variables seleccionadas condicionarán las regiones del paso 2</label>
                        <label id="reg_var">Las variables estan condicionadas por las regiones seleccionadas en el paso 1</label>
                        <!--<a class="btn btn-default btn-xs btn-menu" id="listo_seleccion" data-cerrar="1" style="display:none">
                          Cerrar Lista
                        </a>-->
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

<!-- PERIODO -->
                  <div  id="panel-accordion-3" class="panel-accordion">
                    <div class="header">
                      <div  class="texto-vertical-2">PASO 3</div>
                    </div>
                    <div class="panelContent">
                      <h3 class="titulos_accordion">Período</h3>
                      <hr>

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

<!-- FRECUENCIA -->
                  <div class="panel-accordion">
                    <div class="header">
                      <div  class="texto-vertical-2">PASO 4</div>
                    </div>
                    <div class="panelContent">
                      <h3 class="titulos_accordion">Frecuencia</h3>
                      <hr>

                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <ul class="nav nav-tabs nav-justified altura" role="tablist">
                          <li role="presentation" class="solapa_frecuencia active" data-frecuencia="anual">
                            <a href="#div_anual" role="tab" data-toggle="tab" aria-controls="div_anual">Anual</a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="semestral">
                            <a href="#div_semestral" role="tab" data-toggle="tab" aria-controls="div_semestral">Semestral</a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="trimestral">
                            <a href="#div_trimestral" role="tab" data-toggle="tab" aria-controls="div_trimestral">Trimestral</a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="mensual">
                            <a href="#div_mensual" role="tab" data-toggle="tab" aria-controls="div_mensual">Mensual</a>
                          </li>
                        </ul>
                        <input type="hidden" id="tipo_frecuencia" name="tipo_frecuencia" value="anual">
                        <div class="tab-content">
                            <div id="div_anual" role="tabpanel" class="tab-pane active">
                            </div>
                            <div id="div_semestral" role="tabpanel" class="tab-pane">
                            <select 
                              id="semestral" 
                              name="semestral[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold_simple" 
                              data-height="150"
                              data-maxheight="150">
                                @foreach($semestres as $periodo)
                                  <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div id="div_trimestral" role="tabpanel" class="tab-pane">
                            <select 
                              id="trimestral" 
                              name="trimestral[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold_simple" 
                              data-height="150"
                              data-maxheight="150">
                                @foreach($trimestres as $periodo)
                                  <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div id="div_mensual" role="tabpanel" class="tab-pane">
                            <select 
                              id="mensual" 
                              name="mensual[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold_simple" 
                              data-height="150"
                              data-maxheight="150">
                                @foreach($meses as $periodo)
                                  <option value="{{$periodo->id}}" >{{$periodo->nombre}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
          </div>
          <div class="row">
            <div class="col-md-1 pull-right">
              {!! Form::submit('Buscar', array('class' => 'btn btn-primary btn-block')) !!}
            </div>
          </div>
          {!! Form::close() !!}
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
