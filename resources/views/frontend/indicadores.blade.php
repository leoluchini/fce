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
            <span class="icon-chart-line"></span>
            Indicadores
          </h2>
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

                  <div id="panel-accordion-1" class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">1</p>
                    </div>
                    <div class="panelContent"> 
                      <p class="titulos_accordion">Indicadores</p>
                       <div class="list-group list-plan">
                        <select 
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect" 
                          data-numeropaso="link_paso2"
                          data-nonselectedsext="Escoja las indicadores que le interesen"
                          data-allselectedtext="Todas las indicadores escogidas"
                          data-nselectedtext=" varibles escogidas" 
                          data-height="250"
                          data-maxheight="250">
                            <option value="1" >Ringo</option>
                            <option value="2" >Jhon</option>
                            <option value="3" >Paul</option>
                            <option value="4" >George</option>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div  id="panel-accordion-2" class="panel-accordion">
                    <div class="header">
                      <p class="numeros_accordion">2</p>
                    </div>
                    <div class="panelContent">
                      <p class="titulos_accordion">Región</p>
                      <div class="loading hide">
                        {{ HTML::image('images/ajax-loader.gif') }}
                      </div>
                      <div class="list-group list-plan">
                        <select 
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect" 
                          data-numeropaso="link_paso2"
                          data-nonselectedsext="Escoja las regiones donde le interesa consultar"
                          data-allselectedtext="Todas las indicadores escogidas"
                          data-nselectedtext=" varibles escogidas" 
                          data-height="250"
                          data-maxheight="250">
                            <option value="1" >La rioja</option>
                            <option value="2" >Chubut </option>
                            <option value="3" >La Pampa</option>
                            <option value="4" >Rio Negro</option>
                            <option value="4" >Buenos Aires</option>
                            <option value="4" >Misiones</option>
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
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect" 
                          data-numeropaso="link_paso2"
                          data-nonselectedsext="Escoja el período que le interese"
                          data-allselectedtext="Todas las indicadores escogidas"
                          data-nselectedtext=" indicadores escogidos" 
                          data-height="250"
                          data-maxheight="250">
                            <option value="1" >2000</option>
                            <option value="2" >2001</option>
                            <option value="3" >2002</option>
                            <option value="4" >2003</option>
                            <option value="4" >2004</option>
                            <option value="4" >2005</option>
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
                      <div class="list-plan">
                        <select 
                          id="municipio" 
                          name="municipio[]" 
                          multiple="multiple" 
                          class="bootstrapmultiselect" 
                          data-numeropaso="link_paso2"
                          data-nonselectedsext="Escoja qué frecuencia desea consultar"
                          data-allselectedtext="Todas los indicadores escogidos"
                          data-nselectedtext=" indicadores escogidos" 
                          data-height="250"
                          data-maxheight="250">
                            <option value="1" >Anual</option>
                            <option value="2" >Semestral</option>
                            <option value="3" >trimestral</option>
                            <option value="4" >Mensual</option>
                        </select>
                      </div>
                    </div>
                  </div>

          </div>

      </div>
    </section>


</div>

@endsection