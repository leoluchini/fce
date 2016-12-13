$(document).ready(function () {
  	$(document).on("click", "a.link_paginacion_ajax", function(e) {
  		e.preventDefault();
  		label = $(this).closest('li.subcategoria').find('label.consulta_variables');
		cargar_datos_paginados(label, $(this).prop('href'));

  	});
	$('#arbol_consulta').on('click', function(){
		actualizar_variables_seleccionadas();
		$('#modal_consulta').modal('show');
	});
	$('label.tree-toggler').click(function () {
		if(!$(this).parent().children('div.contenedor').is(":visible")){
			cargar_datos_paginados($(this), $(this).data('href'));
		}
		$(this).parent().children('div.contenedor').toggle(300);
	});
  	$('label.tree-toggler').parent().children('div.contenedor').toggle(1000);
  	$(document).on("click", "a.selector_variable", function(e) {
  		e.preventDefault();
  		agregar_tag_variable($(this).data('id'), $(this).data('nombre'));
  		actualizar_variables_seleccionadas();
  	});
  	$('#modal_consulta').on('hidden.bs.modal', function () {
		actualizar_regiones();
	});
});

function actualizar_variables_seleccionadas()
{
	$('#modal_consulta').find('ul#lista_seleccion_arbol').remove();
	lista = '';
	$('#lista_tags').find('input[name^="variable_id"]').each(function(){
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

function cargar_datos_paginados(label, href){
	var div = label.closest('li').find('div.contenedor');
	$.get( href, function( data ) {
	  if((data.success == true)&&(data.html != undefined)){
	  	  div.empty().html(data.html);
	  	  div.find('div.contenedor_paginacion').find('a').addClass('link_paginacion_ajax');
	  }
	  else{
	  	div.empty().html('<h3>Error.</h3>')
	  }
	});
}