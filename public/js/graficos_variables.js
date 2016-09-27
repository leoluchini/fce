$(function(){

  $(".link_grafico").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
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
    $('#contenedor_grafico').append($('div#graficos_generados').find('#'+$(this).data('grafico')));
  });
  
  $(".link_grafico_comparativo").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
      partes = $(this).data('grafico').split('_');
      
      var item = {id: partes[1], descripcion:frecuencias[partes[1]], unidad:""};
      var categorias = get_values(regiones);
      var lista_info = [];
      var info_multieje = [];

      jQuery.each(variables, function(key, value) {
          valores = get_int_values(datos_anio_region[key][partes[1]]);
          var info = {
                      name: value,
                      data: valores
                    };
          lista_info.push(info);
          var info_m = {
                      variable: {id:key, descripcion:value, unidad:unidades[key]},
                      info: info
                    };;
          info_multieje.push(info_m);
      });

      ancho = 838;
      switch(partes[2]) {
          case 'linea':
              div = generar_div_grafico_linea(ancho, item, categorias, lista_info, partes[0]);
              break;
          case 'radar':
              div = generar_div_grafico_radar(ancho, item, categorias, lista_info, partes[0]);
              break;
          case 'lineamultieje':
              div = generar_div_grafico_linea_multieje(ancho, item, categorias, info_multieje, partes[0]);
              break;
      }

      $('div#graficos_generados').append(div);
    }
    $('#modal_variables').modal('show');
    $('#contenedor_grafico').append($('div#graficos_generados').find('#'+$(this).data('grafico')));
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