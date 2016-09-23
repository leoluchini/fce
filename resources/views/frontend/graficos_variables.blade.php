<!-- Modal -->
<div class="modal fade" id="modal_variables" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Grafico de variable</h4>
      </div>
      <div id="contenedor_grafico" class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--Contenedor de los graficos generados-->
<div id="graficos_generados" style="display:none">
</div>
<script type="text/html" id="loading_image">
  <center><img src="{{ asset('images/ajax-loader.gif') }}"></center>
</script>
<script>
var variables = <?php echo json_encode($info_pivot['variables']) ?>;
var unidades = <?php echo json_encode($info_pivot['unidades']) ?>;
var regiones = <?php echo json_encode($info_pivot['regiones']) ?>;
var frecuencias = <?php echo json_encode($info_pivot['aniofrec']) ?>;
var datos_region_anio = <?php echo json_encode($data_pivot) ?>;
var datos_anio_region = <?php echo json_encode($data_pivot_inversa) ?>;
var datos_adicionales = <?php echo json_encode($datos_adicionales) ?>;
</script>