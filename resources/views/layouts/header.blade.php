<div class="col-xs-12 header_frontend">
  <div class="row">
    <div class="col-xs-4 row">

      <div class="icon_menu">
        <span class="icon-menu pull-left" id='hideshow'></span>
      </div>

      <div class="icon_home">
        <a href="{{url('/')}}"><span class="icon-home-3 pull-left"></span></a>
        @if(Auth::user())
          <a href="{{url('/administracion')}}"><span class="icon-cogs pull-right"></span></a>
        @endif
      </div>
    </div>

    <div class="col-xs-4 row">
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

    <div class="col-xs-4 row pull-right">
      <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
       {!! Html::image('images/menu_horizontal_UNLP.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>'pull-right'])!!}
      </a>
    </div>

  </div>
</div>
<!-- MENU VERTICAL -->
      <div id="Menu" style="display:none">
        <center>
          {!! Html::image('images/logo_menu.png', '', ['class'=>'logoFCE_menu'])!!}
        </center>

        <nav>
          <ul>
            <li><a href="{{action('PublicoController@variables')}}" class="text-right">Variables</a></li>
            <li><a href="{{action('PublicoController@indicadores')}}" class="text-right">Indicadores</a></li>
            <li><a href="{{action('PublicoController@publicaciones')}}" class="text-right">Publicaciones</a></li>
          </ul>
         </nav>

        <div class="contacto_menu text-right blanco ">
          @include('auth.dropdown_login')

          <p class="footer_menu"><small>(+54 221)</small> 423-6769 / 71 / 72</p>
          <p class="footer_menu">6 Nº 777 La Plata | Bs. As.</p>
          <p class="footer_menu"><a href="">sie@econo.unlp.edu.ar</a></p>
        </div>
      </div><!-- FIN MENU VERTICAL -->