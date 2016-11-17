<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>labDATA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {!!Html::style('css/app.css')!!}

        <!-- Fuente CUPRUM -->
    <link href="{{ asset('css/cuprum.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <section class="cuadro-superior">
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


    <section class="cuadro-inferior">
        <div clas="col-xs-12">
            <div class="marco_negro">
                <p class="text-center texto_404">
                    La página que está buscando no existe.
                </p>
            </div>
        </div>
    </section>

</body>
</html>
