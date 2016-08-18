@extends('layouts.app')

@section('content')
    <div class="icon_menu">
        <span class="glyphicon glyphicon-menu-hamburger" id='hideshow'></span>
    </div>
    <div id="Menu">
        SISTEMA DE INFORMACIÓN ECONÓMICA
        <a href="#">Variables</a>
        <a href="#">Indicadores</a>
        <a href="#">Publicaciones</a>
    </div>
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


    <section class="bottom">
        <div clas="col-xs-12">
            <h3 class="text-center">
                <a href="#" class="index-secciones">Variables</a> | <a href="#">Indicadores</a> | <a href="#">Publicaciones</a>
            </h3>
        </div>

        <div class="col-md-6 blanco contacto">
            <a href="#"><h3>Login</h3></a>
            <p>+54 221 423-6769/71/72</p>
            <p>6 Nº 777</p>
            <p>La Plata | Bs. As.</p>
            <p>agustin.lodola@econo.unlp.edu.ar</p>
        </div>
        <div class="col-md-6 blanco">
            <div class="pull-right">
                {!! Html::image('images/firma_unlp.png', 'Universidad Nacional de La Plata')!!}
            </div>
        </div>

    </section>
@endsection
