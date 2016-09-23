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
            <span class="icon-th-list-2"></span>
            Resultados de la consulta de Variables
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="page-body">
  <!-- Plan Section -->
    <div class="container">
      <ol class="breadcrumb">
        DETALLES DE LA CONSULTA: 
        @foreach($busqueda as $label => $colection)
          @if(count($colection) > 1)
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$label}} ({{count($colection)}})<span class="caret"></span></a>
              <ul class="dropdown-menu">
                @foreach($colection as $item)
                <li><a href="#">{{$item}}</a></li>
                @endforeach
              </ul>
            </li>
          @else
          <li> {{$colection[0]}} </li>
          @endif
        @endforeach
        <div class="pull-right" ><a href="#"><span class="icon-spin3"></span></a></div>
      </ol>

<!-- TABLA COMUN -->
<!--       <table class="table table-condensed tabla_resultados_paginada">
        <thead>
          <tr>
            <th>Variable</th>
            <th>Zona</th>
            <th>Año/Frecuencia</th>
            <th>Valor</th>
            <th>Unidad</th>
            <th>Fuente</th>
          </tr>
        </thead>
        <tbody>
            @foreach( $resultados as $info )
              <tr>
                  <td>{{ $info->variable->nombre }}</td>
                  <td>{{ $info->zona->nombre }}</td>
                  <td>{{ $info->anio }}{{ ($info->frecuencia->tipo != 'ANIO') ? ' / '.$info->frecuencia->nombre : '' }}</td>
                  <td>{{ number_format($info->valor, 2, ',', '.') }}</td>
                  <td>{{ $info->unidad_medida->nombre }}</td>
                  <td><span title="{{ $info->fuente->descripcion }}" data-toggle="tooltip" data-placement="top">{{ $info->fuente->codigo }}</span></td>
              </tr>
          @endforeach
        </tbody>
      </table>
    <hr> -->
<!-- FIN TABLA COMUN -->


<!-- TABLA PIVOT-->
      <?php $total = 0 ?>
      @foreach($info_pivot['variables'] as $id_var => $nombre)
      <div class="table-responsive"></div>
        <table class="table table-condensed table-hover">
        <thead>
          <tr class="azul_FCE_bg blanco">
            <th>{{$nombre}}</th>
            @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
            <th class="text-right">{{$aniofrec}}</th>
            @endforeach
            <th class="text-right">TOTAL MUN.</th>
          </tr>
        </thead>
        <tbody>
          @foreach($info_pivot['regiones'] as $id_reg => $zona)
            <tr>
                <td>{{ $zona }}</td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <td class="text-right">{{$data_pivot[$id_var][$id_reg][$id_aniofrec]}}</td>
                @endforeach
                <td class="text-right"><strong>{{ array_sum($data_pivot[$id_var][$id_reg]) }}</strong></td>
                <?php $total += array_sum($data_pivot[$id_var][$id_reg]) ?>
            </tr>
          @endforeach
            <tr class="gris_table_bg">
                <td><strong>TOTAL ANUAL</strong></td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <?php $tot_reg = 0 ?>
                  @foreach($info_pivot['regiones'] as $id_reg => $zona)
                    <?php $tot_reg += $data_pivot[$id_var][$id_reg][$id_aniofrec] ?>
                  @endforeach
                <td class="text-right"><strong>{{$tot_reg}}</strong></td>
                @endforeach
                <td class="text-right"><strong>{{ $total }}</strong></td>
            </tr>
            <tr>
                <td colspan="{{ (count($info_pivot['aniofrec']) + 2) }}">
                  <div class="row">
                    <div class="col-md-6">
                      <h4>
                        Graficos por region: 
                        <a href="#" title="Grafico de linea" class="link_grafico" data-grafico="region_{{$id_var}}_linea">
                          <span class="icon-chart-line"></span>
                        </a>
                        <a href="#" title="Grafico de radar" class="link_grafico" data-grafico="region_{{$id_var}}_radar">
                          <span class="icon-chart-pie-outline"></span>
                        </a>
                        <a href="#" title="Grafico de columnas" class="link_grafico" data-grafico="region_{{$id_var}}_columna">
                          <span class="icon-chart-bar-1"></span>
                        </a>
                        <a href="#" title="Grafico de puntos" class="link_grafico" data-grafico="region_{{$id_var}}_puntos">
                          <span class="icon-chart-alt-outline"></span>
                        </a>
                      </h4>
                    </div>
                    <div class="col-md-6">
                      <h4>
                        Graficos por frecuencia: 
                        <a href="#" title="Grafico de linea" class="link_grafico" data-grafico="frecuencia_{{$id_var}}_linea">
                          <span class="icon-chart-line"></span>
                        </a>
                        <a href="#" title="Grafico de radar" class="link_grafico" data-grafico="frecuencia_{{$id_var}}_radar">
                          <span class="icon-chart-pie-outline"></span>
                        </a>
                        <a href="#" title="Grafico de columnas" class="link_grafico" data-grafico="frecuencia_{{$id_var}}_columna">
                          <span class="icon-chart-bar-1"></span>
                        </a>
                        <a href="#" title="Grafico de puntos" class="link_grafico" data-grafico="frecuencia_{{$id_var}}_puntos">
                          <span class="icon-chart-alt-outline"></span>
                        </a>
                      </h4>
                    </div>
                  </div>
                </td>
            </tr>
        </tbody>
      </table>
      <hr>
      @endforeach
<!-- FIN TABLA PIVOT-->

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_variables">
        Launch demo modal
      </button>

    </div> <!-- fin container -->
</div><!-- fin page-body -->

@include('frontend.graficos_variables')

@endsection
@section('scripts_adicionales')
    
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>

    <script src="{{ asset('Highcharts-4.2.6/js/highcharts.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/funciones_graficos.js') }}"></script>
    <script src="{{ asset('js/graficos_variables.js') }}"></script>
    
@endsection