$(document).ready(function () {
	$('#arbol_consulta').on('click', function(){
		actualizar_indicadores_seleccionadas();
		$('#modal_consulta').modal('show');
	});
	$('label.tree-toggler').click(function () {
		$(this).parent().children('ul.tree').toggle(300);
	});
  	$('label.tree-toggler').parent().children('ul.tree').toggle(1000);
  	//$('a.selector_variable').on('click', function(e){
  	$(document).on("click", "a.selector_indicador", function(e) {
  		e.preventDefault();
  		agregar_tag_indicador($(this).data('id'), $(this).data('nombre'), $(this).data('relacionados'));
  		actualizar_indicadores_seleccionadas();
  	});
  	$('#modal_consulta').on('hidden.bs.modal', function () {
		if($('input[name="tipo_busqueda"]:checked').val() == 'indicador_region'){
			actualizar_regiones();
    	}
    	else{
    		$('#carga_periodos').show();
    		actualizar_periodos();
    	}
	});

	$('label.label_categoria').on('click', function(){
		var lista = $(this).parent().find('ul#contenedor_categoria_'+$(this).data('id'));
		if(lista.find('li').length == 0){
			$('#loading_arbol_indicadores').show();
			var ruta = $('#arbol_categorias_indicadores').data('consulta');
			ruta = ruta.replace(":query:", $(this).data('id'));
			cargar_listado_indicadores(ruta, lista);
		}
	});

	$('label.label_tema').on('click', function(){
		var lista = $(this).parent().find('ul#contenedor_tema_'+$(this).data('id'));
		if(lista.find('li').length == 0){
			$('#loading_arbol_indicadores').show();
			var ruta = $('#arbol_temas_indicadores').data('consulta');
			ruta = ruta.replace(":query:", $(this).data('id'));
			cargar_listado_indicadores(ruta, lista);
		}
	});
});

function actualizar_indicadores_seleccionadas()
{
	$('#modal_consulta').find('ul#lista_seleccion_arbol').remove();
	lista = '';
	$('#lista_tags').find('input[name^="indicador_id"]').each(function(){
		lista = lista + '<li>' + $(this).parent().find('span.texto').attr('title') + '</li>';
	});
	if(lista == ''){
		$('#modal_consulta').find('p#texto_seleccion_arbol').empty().text($('#modal_consulta').find('p#texto_seleccion_arbol').data('default'));
	}
	else{
		$('#modal_consulta').find('p#texto_seleccion_arbol').empty().text('Usted seleccionó: ');
		ul = $('<ul id="lista_seleccion_arbol" style="overflow:auto;max-height: 60px;"></ul>');
		ul.append(lista);
		ul.insertAfter($('#modal_consulta').find('p#texto_seleccion_arbol'));
	}
}

function cargar_listado_indicadores(ruta, ul, callback, param)
{
	$.ajax({
		url: ruta,
		type: 'GET',
		dataType: 'json',
		success: function (data) {
			if(data.length > 0)
			{
				cantidad = data.length;
				$.each(data, function(key, value) {
					var li = $($('#nuevo_selector_indicador').html());
					li.find('a').attr('data-id', value.id);
					li.find('a').attr('data-nombre', value.nombre);
					li.find('a').attr('data-relacionados', value.tema);
					li.find('a').text(value.nombre);
					ul.append(li);
					cantidad--;
					if(cantidad == 0){
						if (typeof callback !== 'undefined') { callback(param); }
					}
				});
			}
			else{
				ul.append('<li><a href="#"> No existen indicadores cargados </a></li>');
				if (typeof callback !== 'undefined') { callback(param); }
			}
			$('#loading_arbol_indicadores').hide();
		},
	});
}