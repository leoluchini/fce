@extends('layouts.app')

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
        <div class="pull-right">
          <a href="#" id="reformular_consulta" data-toggle="tooltip" data-placement="top" title="Redefinir la consulta"><span class="icon-spin3"></span></a>
          <a href="#" id="descargar_excel" data-toggle="tooltip" data-placement="top" title="Descargar Excel"><span class="icon-file-excel"></span></a>
        </div>
      </ol>

<!-- TABLA COMUN -->
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
                  <td><span title="{{ $info->fuente->nombre }}" data-toggle="tooltip" data-placement="top">{{ $info->fuente->codigo }}</span></td>
              </tr>
          @endforeach
        </tbody>
      </table>
    <hr>
<!-- FIN TABLA COMUN -->
    <div class="list-group list-plan">
      <div data-toggle="buttons">
        <h4>Resultados por
          <button  class="btn btn-none active">
            <input type="radio" name="tablas_p" id="tablas_option1" value="variables" autocomplete="off" checked>
            <h4 class="azul_FCE"><span class="icon-check-1"></span>Variables</h4>
          </button>
          ,&nbsp;
          <button class="btn btn-none">
            <input type="radio" name="tablas_p" id="tablas_option2" value="regiones" autocomplete="off">
            <h4 class="azul_FCE_apagado"><span class="icon-check-empty"></span>Regiones</h4>
          </button>
          &nbsp;o&nbsp;
          <button class="btn btn-none">
            <input type="radio" name="tablas_p" id="tablas_option3" value="frecuencias" autocomplete="off">
            <h4 class="azul_FCE_apagado"><span class="icon-check-empty"></span>Frecuencias</h4>
          </button>
        </h4>
      </div>
    </div>
<!-- TABLAS PIVOT-->
    @include('frontend.variables.pivot_variables')      
    @include('frontend.variables.pivot_regiones')      
    @include('frontend.variables.pivot_frecuencias')      
      
<!-- FIN TABLAS PIVOT-->
    </div> <!-- fin container -->
</div><!-- fin page-body -->
@include('frontend.variables.form_oculto_variables')
@include('frontend.variables.graficos_variables')

@endsection
@section('scripts_adicionales')
    
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>

    <script src="{{ asset('Highcharts-4.2.6/js/highcharts.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/themes/sand-signika.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/resultados_variables.js') }}"></script>
    <script src="{{ asset('js/funciones_graficos.js') }}"></script>
    <script src="{{ asset('js/graficos_variables.js') }}"></script>
    
@endsection