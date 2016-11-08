<!-- Modal -->
<div class="modal fade" id="modal_variables" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title">
            <span class="icon-th-list-2"></span>
            Grafico de variable
          </h2>
      </div>
      <div  class="modal-body">
        <center id="contenedor_grafico">

        </center>
      </div>
      <div class="modal-footer">
        <center>
          <div class="header_izquierda">
            <a href="http://www.econo.unlp.edu.ar/laboratorio" target="_blank">
             {!! Html::image('images/menu_horizontal_LAB.png', 'Laboratorio de Desarrollo Sectorial y Territorial', ['class'=>''])!!}
            </a>
            <a href="http://www.econo.unlp.edu.ar" target="_blank" class="border_left">
              {!! Html::image('images/menu_horizontal_FCE.png', 'Facultad de Ciencias Econ&oacute;micas', ['class'=>''])!!}
            </a>
          </div>
        </center>
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
var fuentes = <?php echo json_encode($info_pivot['fuentes']) ?>;
var frecuencias = <?php echo json_encode($info_pivot['aniofrec']) ?>;
var datos_region_anio = <?php echo json_encode($data_pivot) ?>;
var datos_anio_region = <?php echo json_encode($data_pivot_inversa) ?>;
var datos_adicionales = <?php echo json_encode($datos_adicionales) ?>;
var datos_adicionales_region = <?php echo json_encode($datos_adicionales_region) ?>;
var datos_adicionales_frecuencia = <?php echo json_encode($datos_adicionales_frecuencia) ?>;
</script>