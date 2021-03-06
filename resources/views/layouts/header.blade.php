<div class="col-xs-12 header_frontend">
  <div class="row">

    <div class="col-xs-4">
      <div class="row">
        <div class="icon_menu">
          <span class="icon-menu pull-left" id='hideshow' style="cursor:pointer"></span>
        </div>

        @if(Route::getCurrentRoute()->getPath() != '/')
          <div class="icon_home">    
            <a href="{{url('/')}}">
              <span class="icon-home-3 pull-left"></span>
            </a>
          </div>
        @endif

        @if(Auth::user())
          <div class="{{ (Route::getCurrentRoute()->getPath() != '/') ? 'icon_administracion' : 'icon_administracion_index' }}">
              <a href="{{url('/administracion')}}">
                <span class="icon-cogs pull-right"></span></a>
          </div>
        @endif



      </div>
    </div>

    <div class="col-xs-4">
      <center>
        <div class="header_izquierda">
          <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
           {!! Html::image('images/menu_horizontal_LAB.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>''])!!}
          </a>
          <a href="http://www.econo.unlp.edu.ar" target="_blank" class="border_left">
            {!! Html::image('images/menu_horizontal_FCE.png', 'Facultad de Ciencias Econ&oacute;micas', ['class'=>''])!!}
          </a>
        </div>
      </center>
    </div>

    <div class="col-xs-4 pull-right">
      <div class="row">
      <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
       {!! Html::image('images/menu_horizontal_UNLP.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>'pull-right'])!!}
      </a>
      </div>
    </div>

  </div>
</div>

<!-- MENU VERTICAL -->
      <div id="Menu" style="display:none">
        <div class="logo_labdata text-right" >
          <h1>
            lab<i>DATA</i>
          </h1>
        </div>

        <nav>
          <ul>
            <li><a href="{{action('FrontendVariablesController@variables')}}" class="text-right">Variables</a></li>
            <li><a href="{{action('FrontendIndicadoresController@indicadores')}}" class="text-right">Indicadores</a></li>
            <li><a href="{{action('FrontendPublicacionesController@publicaciones')}}" class="text-right">Publicaciones</a></li>
          </ul>
         </nav>

        <div class="contacto_menu text-right blanco ">
          @include('auth.dropdown_login')

          <p class="footer_menu"><small>(+54 221)</small> 423-6769 / 71 / 72</p>
          <p class="footer_menu">6 Nº 777 La Plata | Bs. As.</p>
          <p class="footer_menu"><a href="">sie@econo.unlp.edu.ar</a></p>
        </div>
      </div><!-- FIN MENU VERTICAL -->