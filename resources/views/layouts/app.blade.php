<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de información econ&oacute;mica</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Fuente CUPRUM -->
    <link href="{{ asset('css/cuprum.css') }}" rel="stylesheet" type="text/css">
    <!-- Glypicons FONTELLO -->
    <link href="{{ asset('fontello/css/fontello.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('js/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {!!Html::style('css/app.css')!!}
    <!-- Accordion -->
    <link href="{{ asset('css/accordion.css') }}" rel="stylesheet" type="text/css">

    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>
</head>
<body id="app-layout">
   
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

        <div class="blanco contacto_menu text-right col-xs-2">
          @include('auth.dropdown_login')

          <p class="footer_menu"><small>(+54 221)</small> 423-6769 / 71 / 72</p>
          <p class="footer_menu">6 Nº 777 La Plata | Bs. As.</p>
          <p class="footer_menu"><a href="">sie@econo.unlp.edu.ar</a></p>
        </div>
      </div><!-- FIN MENU VERTICAL -->
   
    @yield('content')
           
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset('js/delete_data_link.js') }}"></script>
    <script src="{{ asset('js/file_inputs.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
    
    <script src="{{ asset('js/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('js/bootstrap_multiselect.js') }}"></script>
    @yield('scripts_adicionales')

</body>
</html>
