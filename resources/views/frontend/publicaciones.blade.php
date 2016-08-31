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
            <span class="icon-note-1"></span>
            Publicaciones
          </h2>
        </div>
      </div>

        </h4>
      </div>
    </div>
  </div>
  <div class="page-body">
  	<div class="row">
      	<div class="col-md-10 col-md-offset-1">

          <ul class="nav nav-tabs nav-justified">
              <li role="presentation" class="active"><a href="#">Productivas</a></li>
              <li role="presentation"><a href="#">Sociales</a></li>
              <li role="presentation"><a href="#">Demográficas</a></li>
              <li role="presentation"><a href="#">Económicas</a></li>
          </ul>

    			<table class="tabla table-responsive table table-hover table-condensed">
    			    <thead>
    			        <tr>
    			            <th><strong>Nombre</strong></p> </th>
    			            <th><strong>Descripcion</strong></p> </th>
    			            <th><strong>Año</strong></p> </th>
    			            <th class="text-right"><p> <strong>Acciones</strong></p></th>
    			        </tr>
    			    </thead>
    			    <tbody id="tabla-datos">
    			        <tr>
                    <td>una publicacion</td>
                    <td>descripcion</td>
                    <td>2016</td>
                    <td class="text-right">
                      <span class="icon-mail-1 pull-right"></span>
                      <span class="icon-down-5 pull-right"></span>
                    </td>
                  </tr>

                  <tr>
                    <td>una publicacion</td>
                    <td>descripcion</td>
                    <td>2016</td>
                    <td class="text-right">
                      <span class="icon-mail-1 pull-right"></span>
                      <span class="icon-down-5 pull-right"></span>
                    </td>
                  </tr>

                   <tr>
                    <td>una publicacion</td>
                    <td>descripcion</td>
                    <td>2016</td>
                    <td class="text-right">
                      <span class="icon-mail-1 pull-right"></span>
                      <span class="icon-down-5 pull-right"></span>
                    </td>
                  </tr>
    			    </tbody>
    			</table>
  		</div>
  	</div>


    </div>
  </div>
</div>
@endsection