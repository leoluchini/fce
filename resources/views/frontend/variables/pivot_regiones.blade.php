    <div id="div_tablas_pivot_regiones" style="display:none">
      @foreach($info_pivot['regiones'] as $id_reg => $nombre)
      <?php $total = 0 ?>
      <div class="table-responsive">
        <table id="tabla_pivot_region_{{$id_reg}}" class="table table-condensed table-hover tabla_resultados_paginada">
        <thead>
          <tr class="azul_FCE_bg blanco">
            <th>{{$nombre}}</th>
            @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
            <th class="text-right">{{$aniofrec}}</th>
            @endforeach
            <th class="text-right">TOTAL REGION</th>
          </tr>
        </thead>
        <tbody>
          @foreach($info_pivot['variables'] as $id_var => $variable)
            <tr>
                <td><span title="FUENTE: {{$info_pivot['fuentes'][$id_var]}} ( en {{$info_pivot['unidades'][$id_var]}} )" data-toggle="tooltip" data-placement="top">{{ $variable }} </span></td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <td class="text-right">{{$data_pivot[$id_var][$id_reg][$id_aniofrec]}}</td>
                @endforeach
                <td class="text-right"><strong>{{ array_sum($data_pivot[$id_var][$id_reg]) }}</strong></td>
                <?php $total += array_sum($data_pivot[$id_var][$id_reg]) ?>
            </tr>
          @endforeach
            <tr class="gris_table_bg">
                <td><strong>TOTAL FREC.</strong></td>
                @foreach($info_pivot['aniofrec'] as $id_aniofrec => $aniofrec)
                <?php $tot_var = 0 ?>
                  @foreach($info_pivot['variables'] as $id_var => $variable)
                    <?php $tot_var += $data_pivot[$id_var][$id_reg][$id_aniofrec] ?>
                  @endforeach
                <td class="text-right"><strong>{{$tot_var}}</strong></td>
                @endforeach
                <td class="text-right"><strong>{{ $total }}</strong></td>
            </tr>
        </tbody>
      </table>
      <p class="help-block text-right" ><a href="#" class="transponer_pivot" data-tablaid="tabla_pivot_region_{{$id_reg}}" data-toggle="tooltip" data-placement="top" title="Transponer datos de la tabla">Transponer tabla <span class="icon-exchange"></span></a></p>
      </div>
      <hr>
      @endforeach
    </div>