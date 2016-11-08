    <div id="div_tablas_pivot_frecuencias" style="display:none">
      <?php $anio_region = array(); ?>
      @foreach($info_pivot['aniofrec'] as $id_aniofrec => $nombre)
      <?php $total = 0; ?>
      <?php $anio_region[$id_aniofrec] = array(); ?>
      <div class="table-responsive">
        <table id="tabla_pivot_frecuencia_{{$id_aniofrec}}" class="table table-condensed table-hover tabla_resultados_paginada">
        <thead>
          <tr class="azul_FCE_bg blanco">
            <th>{{$nombre}}</th>
            @foreach($info_pivot['variables'] as $id_var => $variable)
            <th class="text-right"><span title="FUENTE: {{$info_pivot['fuentes'][$id_var]}} ( en {{$info_pivot['unidades'][$id_var]}} )" data-toggle="tooltip" data-placement="top">{{$variable}}</span></th>
            @endforeach
            <th class="text-right">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($info_pivot['regiones'] as $id_reg => $zona)
            <?php $anio_region[$id_aniofrec][$id_reg] = array(); ?>
            <tr>
                <td>{{ $zona }}</td>
                @foreach($info_pivot['variables'] as $id_var => $variable)
                <td class="text-right">{{$data_pivot[$id_var][$id_reg][$id_aniofrec]}}</td>
                <?php $anio_region[$id_aniofrec][$id_reg][$id_var] = $data_pivot[$id_var][$id_reg][$id_aniofrec]; ?>
                @endforeach
                <td class="text-right"><strong>{{ array_sum($anio_region[$id_aniofrec][$id_reg]) }}</strong></td>
                <?php $total += array_sum($anio_region[$id_aniofrec][$id_reg]) ?>
            </tr>
          @endforeach
            <tr class="gris_table_bg">
                <td><strong>TOTAL VAR.</strong></td>
                @foreach($info_pivot['variables'] as $id_var => $variable)
                <td class="text-right"><strong>{{array_sum($data_pivot_inversa[$id_var][$id_aniofrec])}}</strong></td>
                @endforeach
                <td class="text-right"><strong>{{ $total }}</strong></td>
            </tr>
        </tbody>
      </table>
      <p class="help-block text-right" ><a href="#" class="transponer_pivot" data-tablaid="tabla_pivot_frecuencia_{{$id_aniofrec}}" data-toggle="tooltip" data-placement="top" title="Transponer datos de la tabla">Transponer tabla <span class="icon-exchange"></span></a></p>
      <div class="row">
          
          <div class="col-md-6">
            <h4>
              Graficos por region: 
              <a href="#" title="Grafico de linea" class="link_grafico_frecuencia" data-grafico="frecregion_{{$id_aniofrec}}_linea">
                <span class="icon-chart-line"></span>
              </a>
              <a href="#" title="Grafico de radar" class="link_grafico_frecuencia" data-grafico="frecregion_{{$id_aniofrec}}_radar">
                <span class="icon-chart-pie-outline"></span>
              </a>
              <a href="#" title="Grafico de columnas" class="link_grafico_frecuencia" data-grafico="frecregion_{{$id_aniofrec}}_columna">
                <span class="icon-chart-bar-1"></span>
              </a>
              <a href="#" title="Grafico de puntos" class="link_grafico_frecuencia" data-grafico="frecregion_{{$id_aniofrec}}_puntos">
                <span class="icon-chart-alt-outline"></span>
              </a>
            </h4>
          </div>
          <div class="col-md-6">
            <h4>
              Graficos por variable: 
              <a href="#" title="Grafico de linea" class="link_grafico_frecuencia" data-grafico="frecvariable_{{$id_aniofrec}}_linea">
                <span class="icon-chart-line"></span>
              </a>
              <a href="#" title="Grafico de radar" class="link_grafico_frecuencia" data-grafico="frecvariable_{{$id_aniofrec}}_radar">
                <span class="icon-chart-pie-outline"></span>
              </a>
              <a href="#" title="Grafico de columnas" class="link_grafico_frecuencia" data-grafico="frecvariable_{{$id_aniofrec}}_columna">
                <span class="icon-chart-bar-1"></span>
              </a>
              <a href="#" title="Grafico de puntos" class="link_grafico_frecuencia" data-grafico="frecvariable_{{$id_aniofrec}}_puntos">
                <span class="icon-chart-alt-outline"></span>
              </a>
            </h4>
          </div>
        </div>
      </div>
      <hr>
      @endforeach
    </div>
<script>
var datos_anio_region_variable = <?php echo json_encode($anio_region) ?>;
</script>