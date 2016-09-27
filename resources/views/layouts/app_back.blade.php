<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administración</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Fuente CUPRUM -->
    <link href="{{ asset('css/cuprum.css') }}" rel="stylesheet" type="text/css">
    <!-- Glypicons FONTELLO -->
    <link href="{{ asset('fontello/css/fontello.css') }}" rel="stylesheet" type="text/css">

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
  <div class="row">
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
    </div>
    @if (session()->has('flash_notification.message'))
    <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
    @endif
    @yield('content')
           
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="{{ asset('js/aplicacion.js') }}"></script>
    <script src="{{ asset('js/delete_data_link.js') }}"></script>
    <script src="{{ asset('js/file_inputs.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
    
    
    <link href="{{ asset('bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('js/bootstrap_multiselect.js') }}"></script>
    @yield('scripts_adicionales')

</body>
</html>
