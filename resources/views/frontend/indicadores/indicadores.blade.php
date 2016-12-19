@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="page-header">
          <h1>
            <span class="icon-th-list-2"></span>
            Indicadores
          </h1>
      </div>
    </div>
  </div>
</div>
<div class="container" id="espera_carga_previa" style="{{ isset($consulta) ? 'display:block' : 'display:none' }}">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          Cargando consulta previa
        </div>
      </div>
    </div>
  </div>
</div>

{!! Form::open(array('action' => ['FrontendIndicadoresController@resultados_indicadores'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'consulta_indicadores' )) !!}
<div class="container" id="div_titulo_busqueda" style="{{ isset($consulta) ? 'display:none' : 'display:block' }}">
    <div class="row">
      <div class="col-xs-12"> 
        <div class="list-group list-plan">
          <div data-toggle="buttons">
            <h4>Realizar búsqueda por
              <button  class="btn btn-none active">
                <input type="radio" name="tipo_busqueda" id="busqueda_option1" value="region_indicador" autocomplete="off" checked>
                <h4 class="azul_FCE"><span class="icon-check-1"></span>Territorio</h4>
              </button>
              o por
              <button class="btn btn-none">
                <input type="radio" name="tipo_busqueda" id="busqueda_option2" value="indicador_region" autocomplete="off">
                <h4 class="azul_FCE_apagado"><span class="icon-check-empty"></span>Indicador</h4>
              </button>
            </h4>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="page-body" id="div_pagina" style="{{ isset($consulta) ? 'display:none' : 'display:block' }}">
    <section id="plan" class="full-section">
        <div class="container">
                <div id="accordion">
                  <div id="panel-accordion-1" class="panel-accordion">
<!-- TERRITORIO-->
                    <div class="header" id="div_paso_1">
                      <div  class="texto-vertical-2">PASO 1</div>
                    </div>

                    <div class="panelContent">
                      <h3 class="titulos_accordion">
                          Territorio&nbsp;
                          <a id="activar_cascada" href="#"><span class="icon-toggle-off pull-right" data-toggle="tooltip" data-placement="left" title="Activar filtro de territorios en cascada"></span></a>
                          <a id="desactivar_cascada" href="#" style="display:none"><span class="icon-toggle-on pull-right" data-toggle="tooltip" data-placement="left" title="Desactivar filtro de territorios en cascada"></span></a>
                          <input id="filtro_cascada" type="checkbox" style="display:none">
                        </h3>
                      <hr>

                      <div class="loading hide">
                        {{ Html::image('images/ajax-loader.gif') }}
                      </div>
                      <ul class="nav nav-tabs nav-justified altura" role="tablist">
                          <li role="presentation" class="solapa_zona active" data-region="pais">
                            <a href="#div_pais" role="tab" data-toggle="tab" aria-controls="div_pais"><span class="icon-right-open-1 icono_filtro_cascada" style="display:none"></span>Países</a>
                            
                          </li>
                          <li role="presentation" class="solapa_zona" data-region="provincia">
                            <a href="#div_provincia" role="tab" data-toggle="tab" aria-controls="div_provincia"><span class="icon-right-open-1 icono_filtro_cascada" style="display:none"></span>Provincias</a>
                          </li>
                          <li role="presentation" class="solapa_zona" data-region="municipio">
                            <a href="#div_municipio" role="tab" data-toggle="tab" aria-controls="div_municipio"><span class="icon-right-open-1 icono_filtro_cascada" style="display:none"></span>Municipios/Departamentos</a>
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
                              data-height="200"
                              data-maxheight="200">
                            </select>
                          </div>
                          <div id="div_provincia" role="tabpanel" class="tab-pane">
                           <select 
                              id="provincia" 
                              name="provincia[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold" 
                              data-height="200"
                              data-maxheight="200">
                            </select>
                          </div>
                          <div id="div_municipio"role="tabpanel" class="tab-pane">
                             <select 
                              id="municipio" 
                              name="municipio[]" 
                              multiple="multiple" 
                              class="bootstrapmultiselect_unfold" 
                              data-height="200"
                              data-maxheight="200">
                            </select>
                          </div>
                      </div>
                    </div>
                  </div>
                     

<!-- INDICADORES -->

                  <div  id="panel-accordion-2" class="panel-accordion">
                    <div class="header">
                      <div  class="texto-vertical-2">PASO 2</div>
                    </div>
                    <div class="panelContent"> 
                      <h3 class="titulos_accordion">Indicadores <a id="arbol_consulta" href="#"><span class="icon-flow-tree pull-right" data-toggle="tooltip" data-placement="left" title="Arbol de indicadores"></span></a></h3>
                      <hr>

                       <div class="list-group list-plan" id="div_lista_seleccion_autocompletar">
                        <label id="ind_reg" style="display:none">Los indicadores seleccionados condicionarán las regiones del paso 2</label>
                        <label id="reg_ind">Los indicadores estan condicionados por las regiones seleccionadas en el paso 1</label>
                        <div id="tilde_indicador_agregado" class="pull-right" style="display:none">
                          <span class="icon-ok-outline"></span>
                        </div>
                        <input type="text" 
                                class="form-control" 
                                id="indicador" 
                                name="indicador" 
                                value="" 
                                placeholder="Busque indicadores ingresando 3 o m&aacute;s caracteres" 
                                data-urlconsulta="{{action('FrontendIndicadoresController@consulta_indicadores')}}" 
                                data-token="{{ csrf_token() }}"
                                data-consultaregiones="{{action('FrontendIndicadoresController@consulta_regiones', [':query:'])}}" />
                      </div>
                      <div class="col-md-12" id="div_lista_tags">
                        <div class="mb-container" style="overflow:auto;max-height: 180px;">
                          <ul style="padding-left: 0px" id="lista_tags">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

<!-- PERIODO -->
                  <div  id="panel-accordion-3" class="panel-accordion">
                    <div class="header" id="paso_3">
                      <div  class="texto-vertical-2">PASO 3</div>
                    </div>
                    <div class="panelContent">
                      <h3 class="titulos_accordion">Período</h3>
                      <hr>

                      <div class="loading hide">
                        {{ Html::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <label id="carga_periodos" style="display:none">
                          <img src="{{ asset('images/ajax-loader.gif') }}">
                          Calculando periodos con informacion para la seleccion realizada de indicadores y regiones
                        </label>
                        <select 
                          id="periodo" 
                          name="periodo[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect_unfold" 
                          data-height="300"
                          data-maxheight="300"
                          data-urlconsulta="{{action('FrontendIndicadoresController@consulta_periodos')}}"
                          data-consultafrec="{{action('FrontendIndicadoresController@consulta_frecuencias')}}">
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
                        {{ Html::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <label id="carga_frecuencias" style="display:none">
                          <img src="{{ asset('images/ajax-loader.gif') }}">
                          Calculando frecuencias con informacion para la seleccion realizada de indicadores, regiones y periodos
                        </label>
                        <ul class="nav nav-tabs nav-justified altura" role="tablist">
                          <li role="presentation" class="solapa_frecuencia active" data-frecuencia="anual">
                            <a href="#div_anual" role="tab" data-toggle="tab" aria-controls="div_anual">
                              Anual
                              <span id="frec_anual_ok" class="icon-ok-squared" style="display:none"></span>
                              <span id="frec_anual_no" class="icon-block" style="display:none"></span>
                            </a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="semestral">
                            <a href="#div_semestral" role="tab" data-toggle="tab" aria-controls="div_semestral">
                              Semestral
                              <span id="frec_semestral_ok" class="icon-ok-squared" style="display:none"></span>
                              <span id="frec_semestral_no" class="icon-block" style="display:none"></span>
                            </a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="trimestral">
                            <a href="#div_trimestral" role="tab" data-toggle="tab" aria-controls="div_trimestral">
                              Trimestral
                              <span id="frec_trimestral_ok" class="icon-ok-squared" style="display:none"></span>
                              <span id="frec_trimestral_no" class="icon-block" style="display:none"></span>
                            </a>
                          </li>
                          <li role="presentation" class="solapa_frecuencia" data-frecuencia="mensual">
                            <a href="#div_mensual" role="tab" data-toggle="tab" aria-controls="div_mensual">
                              Mensual
                              <span id="frec_mensual_ok" class="icon-ok-squared" style="display:none"></span>
                              <span id="frec_mensual_no" class="icon-block" style="display:none"></span>
                            </a>
                          </li>
                        </ul>
                        <input type="hidden" id="tipo_frecuencia" name="tipo_frecuencia" value="anual">
                        <div class="tab-content">
                            <div id="div_anual" role="tabpanel" class="tab-pane active">
                              <p>Resultados por año</p>
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
            <div class="col-md-12 ">
              {!! Form::submit('Buscar', array('class' => 'btn btn-primary btn-block')) !!}
            </div>
          </div>
      </div>
    </section>
</div>
{!! Form::close() !!}
@include('frontend.indicadores.indicadores_arbol_consulta')
@if(isset($consulta))
<script>
  var consulta = <?php echo json_encode($consulta) ?>;
</script>
@endif

<style>
  .image_background_loading{
    background: white url("{{ asset('images/ajax-loader.gif') }}") right no-repeat;
  }
  .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden; width: 55% !important;}
  .options-wrapper {
    max-height: 150px !important;
    overflow-x: hidden;
    overflow-y: auto; 
    padding: 0 0px;
  }
  .multiselect-container>.options-wrapper>li{padding:0}
  .multiselect-container>.options-wrapper>li>a.multiselect-all label{font-weight:700}
  .multiselect-container>.options-wrapper>li.multiselect-group label{margin:0;padding:3px 20px 3px 20px;height:100%;font-weight:700}
  .multiselect-container>.options-wrapper>li.multiselect-group-clickable label{cursor:pointer}
  .multiselect-container>.options-wrapper>li>a{padding:0}
  .multiselect-container>.options-wrapper>li>a>label{margin:0;height:100%;cursor:pointer;font-weight:400;padding:3px 20px 3px 40px}
  .multiselect-container>.options-wrapper>li>a>label.radio,.multiselect-container>.options-wrapper>li>a>label.checkbox{margin:0}
  .multiselect-container>.options-wrapper>li>a>label>input[type=checkbox]{margin-bottom:5px}
  .dropdown-menu > .options-wrapper > li > a {
      clear: both;
      color: #333;
      display: block;
      font-weight: 400;
      line-height: 1.42857;
      padding: 3px 20px;
      white-space: nowrap;
  }
  .dropdown-menu > .options-wrapper > .active > a {
      background-color: #555;
  }
  .dropdown-menu > .options-wrapper > .active > a, .dropdown-menu > .options-wrapper > .active > a:focus, .dropdown-menu > .options-wrapper > .active > a:hover {
      /*background-color: #337ab7;*/
      color: #fff;
      outline: 0 none;
      text-decoration: none;
  }
  .ui-autocomplete.ui-widget {
    font-family: "cuprumregular" !important;
  }
</style>
<script type="text/html" id="agregar_indicador">
  <li style="opacity: 1; list-style-type: none" data-tag="">
    <span class="texto"></span>
    <a href="#" class="ver_indicadores_relacionados" ><span class="icon-link-outline" data-toggle="tooltip" data-placement="bottom" title="Ver indicadores relacionadas"></span></a>
    <input type="hidden" value="" name="">
    <a class="mb-tag-remove pull-right"><span class="icon-trash-4" data-toggle="tooltip" data-placement="bottom" title="Eliminar"></span> </a>
  </li>
</script>
<script type="text/html" id="listado_paises">
  @foreach($paises as $zona)
    <option value="{{$zona->id}}" >{{$zona->fullName()}}</option>
  @endforeach
</script>
<script type="text/html" id="listado_provincias">
  @foreach($provincias as $zona)
    <option value="{{$zona->id}}" data-padreid="{{$zona->pais->id}}">{{$zona->fullName()}}</option>
  @endforeach
</script>
<script type="text/html" id="listado_municipios">
  @foreach($municipios as $zona)
    <option value="{{$zona->id}}" data-padreid="{{$zona->provincia->id}}">{{$zona->fullName()}}</option>
  @endforeach
</script>
<script type="text/html" id="listado_periodos">
  @foreach($periodos as $periodo)
    <option value="{{$periodo}}" >{{$periodo}}</option>
  @endforeach
</script>
@endsection
@section('scripts_adicionales')
    <script src="{{ asset('js/indicadores/filtros_indicadores.js') }}"></script>
    <script src="{{ asset('js/indicadores/arbol_consulta_indicadores.js') }}"></script>
    <link href="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.css') }}" rel="stylesheet">*
    <script src="{{ asset('jquery-ui-1.12.0.smoothness/jquery-ui.min.js') }}"></script>
@endsection
