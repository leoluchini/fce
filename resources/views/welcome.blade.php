@extends('layouts.app')

@section('content')

    <section class="top">
        <div class="contenedor_logos">
            <div class="col-xs-6">
                <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
                    {!! Html::image('images/logo_laboratorio.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>'pull-right'])!!}
                </a>
            </div>
            <div class="col-xs-6 border_left">
                <a href="http://www.econo.unlp.edu.ar" target="_blank">
                    {!! Html::image('images/logo_facultad.png', 'Facultad de Ciencias Econ&oacute;micas', ['class'=>'pull-left'])!!}
                </a>
            </div>
        </div>
    </section>


    <header id="myCarousel" class="carousel slide" style="height:50%">
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol> -->

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{asset('images/fondo-variables.jpg')}}');"></div>
                <!--<div class="carousel-caption">
                    <h2>Variables</h2>
                </div>-->
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{asset('images/fondo-indicadores.jpg')}}');"></div>
                <!--<div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>-->
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('{{asset('images/fondo-publicaciones.jpg')}}');"></div>
                <!--<div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>-->
            </div>
        </div>
    </header>
    
    <section class="bottom">
        <div clas="col-xs-12">
                <p class="text-center titulo_index">
                    Sistema de información económica
                </p>
               <p class="text-center secciones_index">
                <a href="{{action('PublicoController@variables')}}">Variables</a> | <a href="{{action('PublicoController@indicadores')}}">Indicadores</a> | <a href="{{action('PublicoController@publicaciones')}}">Publicaciones</a>
            </p>
        </div>

        <div class="blanco contacto_menu text-right col-xs-2">
          <a href="#">
            <h4>Login</h4>
          </a>

          <p class="footer_menu"><small>(+54 221)</small> 423-6769 / 71 / 72</p>
          <p class="footer_menu">6 Nº 777 La Plata | Bs. As.</p>
          <p class="footer_menu"><a href="">sie@econo.unlp.edu.ar</a></p>
        </div>


        <div class="col-md-6 blanco">
            <div class="pull-right">
                {!! Html::image('images/firma_unlp.png', 'Universidad Nacional de La Plata')!!}
            </div>
        </div>
 

    </section>


@endsection
@section('scripts_adicionales')
    <link href="{{ asset('startbootstrap-full-slider/css/full-slider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('startbootstrap-full-slider/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('startbootstrap-full-slider/js/bootstrap.min.js') }}"></script>
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
@endsection