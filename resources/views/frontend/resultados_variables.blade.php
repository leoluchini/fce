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
        </tbody>
      </table>
      <hr>
      @endforeach
<!-- FIN TABLA PIVOT-->

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Launch demo modal
      </button>

    </div> <!-- fin container -->
</div><!-- fin page-body -->






@endsection
@section('scripts_adicionales')
    
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>

    <script src="{{ asset('Highcharts-4.2.6/js/highcharts.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/modules/exporting.js') }}"></script>
    <script>
      $(function () {
        $('#myModal').on('shown.bs.modal', function() {
          var ancho = $('#grafico').parent().outerWidth() - 30;
          $('#grafico').highcharts({
              chart: {
                  type: 'column',
                  width: ancho
              },
              title: {
                  text: 'Monthly Average Rainfall'
              },
              subtitle: {
                  text: 'Source: WorldClimate.com'
              },
              xAxis: {
                  categories: [
                      'Jan',
                      'Feb',
                      'Mar',
                      'Apr',
                      'May',
                      'Jun',
                      'Jul',
                      'Aug',
                      'Sep',
                      'Oct',
                      'Nov',
                      'Dec'
                  ],
                  crosshair: true
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Rainfall (mm)'
                  }
              },
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              series: [{
                  name: 'Tokyo',
                  data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

              }, {
                  name: 'New York',
                  data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

              }, {
                  name: 'London',
                  data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

              }, {
                  name: 'Berlin',
                  data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

              }]
          });
        })
    });
    </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Grafico de variable</h4>
      </div>
      <div class="modal-body">
        <div id="grafico">
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>