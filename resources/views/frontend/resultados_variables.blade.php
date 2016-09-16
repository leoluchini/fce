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
      </ol>
      <table class="table table-condensed tabla_resultados_paginada">
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
    </div>
    <hr>
    <div class="container">
      <?php $total = 0 ?>
      @foreach($info_pivot['variables'] as $id_var => $nombre)
        <table class="table">
        <thead>
          <tr>
            <th>{{$nombre}}</th>
            @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
            <th>{{$aniofrec}}</th>
            @endforeach
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($info_pivot['regiones'] as $id_reg => $zona)
            <tr>
                <td>{{ $zona }}</td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <td>{{$data_pivot[$id_var][$id_reg][$id_aniofrec]}}</td>
                @endforeach
                <td><strong>{{ array_sum($data_pivot[$id_var][$id_reg]) }}</strong></td>
                <?php $total += array_sum($data_pivot[$id_var][$id_reg]) ?>
            </tr>
          @endforeach
            <tr>
                <td> - </td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <?php $tot_reg = 0 ?>
                  @foreach($info_pivot['regiones'] as $id_reg => $zona)
                    <?php $tot_reg += $data_pivot[$id_var][$id_reg][$id_aniofrec] ?>
                  @endforeach
                <td><strong>{{$tot_reg}}</strong></td>
                @endforeach
                <td><strong>{{ $total }}</strong></td>
            </tr>
        </tbody>
      </table>
      @endforeach
    </div>
</section>


</div>

@endsection
@section('scripts_adicionales')
    
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>
@endsection