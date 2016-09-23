$(function(){
	$(window).load(function(e) {
		/*jQuery.each(info_json.info.variables, function() {
			alert(this)
		});*/
	});
  $(".link_grafico").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
      //$('#contenedor_grafico').append($($('#loading_image').html()));
      //$('#modal_variables').modal('show');
      //$('#contenedor_grafico').data('grafico', $(this).data('grafico'));
      partes = $(this).data('grafico').split('_');
      variable = {id:partes[1], descripcion:variables[partes[1]], unidad:unidades[partes[1]]};
      serie = [];
      if(partes[0] == 'region'){
        categorias = get_values(frecuencias);
        jQuery.each(regiones, function(key, value) {
          lista = get_int_values(datos_region_anio[partes[1]][key]);
          dato = {
                  name: regiones[key],
                  data: lista
                };
          serie.push(dato);
        });
      }
      else{
        categorias = get_values(regiones);
        jQuery.each(frecuencias, function(key, value) {
          lista = get_int_values(datos_anio_region[partes[1]][key]);
          dato = {
                  name: frecuencias[key],
                  data: lista
                };
          serie.push(dato);
        });
      }
      ancho = 838;
      switch(partes[2]) {
          case 'linea':
              div = generar_div_grafico_linea(ancho, variable, categorias, serie, partes[0]);
              break;
          case 'radar':
              div = generar_div_grafico_radar(ancho, variable, categorias, serie, partes[0]);
              break;
          case 'columna':
              promedio = (partes[0] == 'region') ? datos_adicionales[partes[1]].promedio_regional : datos_adicionales[partes[1]].promedio_frecuencia;
              div = generar_div_grafico_columna(ancho, variable, categorias, serie, partes[0], promedio);
              break;
          case 'puntos':
              div = generar_div_grafico_puntos(ancho, variable, categorias, serie, partes[0], datos_adicionales[partes[1]].max, datos_adicionales[partes[1]].min);
              break;
      }
      $('div#graficos_generados').append(div);
    }
    $('#modal_variables').modal('show');
    //$('#contenedor_grafico').empty();
    $('#contenedor_grafico').append($('div#graficos_generados').find('#'+$(this).data('grafico')));
  });

	$('#modal_variables').on('shown.bs.modal', function() {
        /*$('#contenedor_grafico').empty();
		    $('#contenedor_grafico').append($($('#loading_image').html()));*/
        /*grafico = $('div#graficos_generados').find('#'+$(this).data('grafico')).clone();
        $('#contenedor_grafico').append(grafico);*/
          /*var ancho = $('#contenedor_grafico').outerWidth() - 30;
          div = $("<div></div>");
          div.highcharts({
              chart: {
                  type: 'column',
                  width: ancho
              },
              title: {
                  text: variables[1]
              },
              subtitle: {
                  text: 'Source: WorldClimate.com'
              },
              xAxis: {
                  categories: get_values(frecuencias),
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
                  name: regiones[26],
                  data:  get_int_values(datos_region_anio[1][26])
              }, {
                  name: regiones[27],
                  data: get_int_values(datos_region_anio[1][27])

              }]
          });
		      $('#contenedor_grafico').append(div);*/
        });
});

function get_values(asociativo)
{
	arr = [];
	jQuery.each(asociativo, function(key, value) {
		arr.push(value);
	});
	return arr;
}
function get_int_values(asociativo)
{
	arr = [];
	jQuery.each(asociativo, function(key, value) {
		arr.push(+value);
	});
	return arr;
}