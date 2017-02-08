@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-header">
    <div class="row">

      <div class="col-xs-12"> 
        <div class=" pull-left"> 
          <h2>
            <span class="icon-th-list-2"></span>
            Resultados de la consulta de Indicadores
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
          <a href="{{action('FrontendIndicadoresController@indicadores')}}" data-toggle="tooltip" data-placement="top" title="Nueva consulta"><span class="icon-eraser"></span></a>
        </div>
      </ol>

<!-- TABLA COMUN -->
<table class="table table-condensed tabla_resultados_paginada">
        <thead>
          <tr>
            <th>Indicador</th>
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
                  <td>{{ $info->indicador->nombre }}</td>
                  <td>{{ $info->zona->fullName() }}</td>
                  <td>{{ $info->anio }}{{ ($info->frecuencia->tipo != 'ANIO') ? ' / '.$info->frecuencia->nombre : '' }}</td>
                  <td>
                    @if($info->dato_adicional())
                        <span data-toggle="tooltip" data-position="top" title="{{$info->dato_adicional()}}">
                          {{ number_format($info->valor, 2, ',', '.') }}
                        </span>
                      @else
                        {{ number_format($info->valor, 2, ',', '.') }}
                      @endif
                  </td>
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
            <input type="radio" name="tablas_p" id="tablas_option1" value="indicadores" autocomplete="off" checked>
            <h4 class="azul_FCE"><span class="icon-check-1"></span>Indicadores</h4>
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
    @include('frontend.indicadores.pivot_indicadores')      
    @include('frontend.indicadores.pivot_regiones')      
    @include('frontend.indicadores.pivot_frecuencias')      
      
<!-- FIN TABLAS PIVOT-->
    </div> <!-- fin container -->
</div><!-- fin page-body -->
@include('frontend.indicadores.form_oculto_indicadores')
@include('frontend.indicadores.graficos_indicadores')

@endsection
@section('scripts_adicionales')
    
    <link href="{{ asset('DataTables-1.10.12/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/js/dataTables.bootstrap.min.js') }}"></script>
    <!--DataTables export a pdf y excel-->
    <link href="{{ asset('DataTables-1.10.12/Buttons-1.2.2/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/jszip.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/pdfmake.min.js') }}"></script>
    <script src="{{ asset('DataTables-1.10.12/Buttons-1.2.2/vfs_fonts.js') }}"></script>
    
    <script src="{{ asset('js/tabla_paginada.js') }}"></script>

    <script src="{{ asset('Highcharts-4.2.6/js/highcharts.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/highcharts-more.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/themes/sand-signika.js') }}"></script>
    <script src="{{ asset('Highcharts-4.2.6/js/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/funciones_graficos.js') }}"></script>
    <script src="{{ asset('js/indicadores/resultados_indicadores.js') }}"></script>
    <script src="{{ asset('js/indicadores/graficos_indicadores.js') }}"></script>
    
@endsection