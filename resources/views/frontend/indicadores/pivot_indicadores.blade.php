    <div id="div_tablas_pivot_indicadores">
      @foreach($info_pivot['indicadores'] as $id_ind => $nombre)
      <?php $total = 0 ?>
      <div class="table-responsive">
        <p class="help-block text-right" >FUENTE: {{$info_pivot['fuentes'][$id_ind]}}</p>
        <table id="tabla_pivot_{{$id_ind}}" class="table table-condensed table-hover tabla_resultados_paginada">
          <thead>
            <tr class="azul_FCE_bg blanco">
              <th>{{$nombre}} <small>( en {{$info_pivot['unidades'][$id_ind]}} )</small></th>
              @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
              <th class="text-right">{{$aniofrec}}</th>
              @endforeach
              <th class="text-right">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            @foreach($info_pivot['regiones'] as $id_reg => $zona)
              <tr>
                  <td>{{ $zona }}</td>
                  @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                  <td class="text-right">{{$data_pivot[$id_ind][$id_reg][$id_aniofrec]}}</td>
                  @endforeach
                  <td class="text-right"><strong>{{ array_sum($data_pivot[$id_ind][$id_reg]) }}</strong></td>
                  <?php $total += array_sum($data_pivot[$id_ind][$id_reg]) ?>
              </tr>
            @endforeach
              <tr class="gris_table_bg">
                  <td><strong>TOTAL FREC.</strong></td>
                  @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                  <?php $tot_reg = 0 ?>
                    @foreach($info_pivot['regiones'] as $id_reg => $zona)
                      <?php $tot_reg += $data_pivot[$id_ind][$id_reg][$id_aniofrec] ?>
                    @endforeach
                  <td class="text-right"><strong>{{$tot_reg}}</strong></td>
                  @endforeach
                  <td class="text-right"><strong>{{ $total }}</strong></td>
              </tr>
          </tbody>
        </table>
        <p class="help-block text-right" ><a href="#" class="transponer_pivot" data-tablaid="tabla_pivot_{{$id_ind}}" data-toggle="tooltip" data-placement="top" title="Transponer datos de la tabla">Transponer tabla <span class="icon-exchange"></span></a></p>
        <div class="row">
          <div class="col-md-6">
            <h4>
              Graficos por region: 
              <a href="#" title="Grafico de linea" class="link_grafico" data-grafico="region_{{$id_ind}}_linea">
                <span class="icon-chart-line"></span>
              </a>
              <a href="#" title="Grafico de radar" class="link_grafico" data-grafico="region_{{$id_ind}}_radar">
                <span class="icon-chart-pie-outline"></span>
              </a>
              <a href="#" title="Grafico de columnas" class="link_grafico" data-grafico="region_{{$id_ind}}_columna">
                <span class="icon-chart-bar-1"></span>
              </a>
              <a href="#" title="Grafico de puntos" class="link_grafico" data-grafico="region_{{$id_ind}}_puntos">
                <span class="icon-chart-alt-outline"></span>
              </a>
            </h4>
          </div>
          <div class="col-md-6">
            <h4>
              Graficos por frecuencia: 
              <a href="#" title="Grafico de linea" class="link_grafico" data-grafico="frecuencia_{{$id_ind}}_linea">
                <span class="icon-chart-line"></span>
              </a>
              <a href="#" title="Grafico de radar" class="link_grafico" data-grafico="frecuencia_{{$id_ind}}_radar">
                <span class="icon-chart-pie-outline"></span>
              </a>
              <a href="#" title="Grafico de columnas" class="link_grafico" data-grafico="frecuencia_{{$id_ind}}_columna">
                <span class="icon-chart-bar-1"></span>
              </a>
              <a href="#" title="Grafico de puntos" class="link_grafico" data-grafico="frecuencia_{{$id_ind}}_puntos">
                <span class="icon-chart-alt-outline"></span>
              </a>
            </h4>
          </div>
        </div>
      </div>
      <hr>
      @endforeach
    </div>