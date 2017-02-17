$(function(){

  $(".link_grafico").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
      partes = $(this).data('grafico').split('_');
      variable = {id:partes[1], descripcion:indicadores[partes[1]], unidad:unidades[partes[1]], fuente: 'Fuente: '+fuentes[partes[1]]};
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
    $('#modal_indicadores').modal('show');
    $('#contenedor_grafico').append($('div#graficos_generados').find('#'+$(this).data('grafico')));
  });

  $(".link_grafico_region").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
      partes = $(this).data('grafico').split('_');
      variable = {id:partes[1], descripcion:regiones[partes[1]], unidad:'', fuente: ''};
      serie = [];
      if(partes[0] == 'regindicador'){
        categorias = get_values(frecuencias);
        jQuery.each(indicadores, function(key, value) {
          lista = get_int_values(datos_region_anio[key][partes[1]]);
          dato = {
                  name: indicadores[key],
                  data: lista
                };
          serie.push(dato);
        });
      }
      else{
        categorias = get_values(indicadores);
        jQuery.each(frecuencias, function(key, value) {
          lista = get_int_values(datos_anio_region_indicador[key][partes[1]]);
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
              promedio = (partes[0] == 'regindicador') ? datos_adicionales_region[partes[1]].promedio_indicador : datos_adicionales_region[partes[1]].promedio_frecuencia;
              div = generar_div_grafico_columna(ancho, variable, categorias, serie, partes[0], promedio);
              break;
          case 'puntos':
              div = generar_div_grafico_puntos(ancho, variable, categorias, serie, partes[0], datos_adicionales_region[partes[1]].max, datos_adicionales_region[partes[1]].min);
              break;
      }
      $('div#graficos_generados').append(div);
    }
    $('#modal_indicadores').modal('show');
    $('#contenedor_grafico').append($('div#graficos_generados').find('#'+$(this).data('grafico')));
  });

  $(".link_grafico_frecuencia").on('click', function(e){
    e.preventDefault();
    $('div#graficos_generados').append($('#contenedor_grafico').contents());
    if($('div#graficos_generados').find('#'+$(this).data('grafico')).length == 0)
    {
      partes = $(this).data('grafico').split('_');
      variable = {id:partes[1], descripcion:frecuencias[partes[1]], unidad:'', fuente: ''};
      serie = [];
      if(partes[0] == 'frecregion'){
        categorias = get_values(indicadores);
        jQuery.each(regiones, function(key, value) {
          lista = get_int_values(datos_anio_region_indicador[partes[1]][key]);
          dato = {
                  name: regiones[key],
                  data: lista
                };
          serie.push(dato);
        });
      }
      else{
        categorias = get_values(regiones);
        jQuery.each(indicadores, function(key, value) {
          lista = get_int_values(datos_anio_region[key][partes[1]]);
          dato = {
                  name: indicadores[key],
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
              promedio = (partes[0] != 'frecregion') ? datos_adicionales_frecuencia[partes[1]].promedio_regional : datos_adicionales_frecuencia[partes[1]].promedio_indicador;
              div = generar_div_grafico_columna(ancho, variable, categorias, serie, partes[0], promedio);
              break;
          case 'puntos':
              div = generar_div_grafico_puntos(ancho, variable, categorias, serie, partes[0], datos_adicionales_frecuencia[partes[1]].max, datos_adicionales_frecuencia[partes[1]].min);
              break;
      }
      $('div#graficos_generados').append(div);
    }
    $('#modal_indicadores').modal('show');
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