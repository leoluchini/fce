<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-106356847-1', 'auto');
      ga('send', 'pageview');

    </script>
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
    @include('layouts.header_back')
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
    <link href="{{ asset('jqconfirm/jquery-confirm.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('jqconfirm/jquery-confirm.js') }}"></script>
    <script src="{{ asset('js/delete_data_link.js') }}"></script>
    <script src="{{ asset('js/file_inputs.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>
    
    
    <link href="{{ asset('bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('js/bootstrap_multiselect.js') }}"></script>
    @yield('scripts_adicionales')

<div class="modal fade" id="generic_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"></h3>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<script type="text/html" id="botones_confirmacion">
  <a href="#" class="btn btn-default btn-sm" data-dismiss="modal" id="button-cancel">Cancelar</a>
  <a href="#" class="btn btn-primary btn-sm" id="button-ok">Aceptar</a>
</script>
</body>
</html>
