$(document).ready(function () {
	$('#arbol_consulta').on('click', function(){
		actualizar_variables_seleccionadas();
		$('#modal_consulta').modal('show');
	});
	$('label.tree-toggler').click(function () {
		$(this).parent().children('ul.tree').toggle(300);
	});
  	$('label.tree-toggler').parent().children('ul.tree').toggle(1000);
  	//$('a.selector_variable').on('click', function(e){
  	$(document).on("click", "a.selector_variable", function(e) {
  		e.preventDefault();
  		agregar_tag_variable($(this).data('id'), $(this).data('nombre'), $(this).data('relacionados'));
  		actualizar_variables_seleccionadas();
  	});
  	$('#modal_consulta').on('hidden.bs.modal', function () {
		if($('input[name="tipo_busqueda"]:checked').val() == 'variable_region'){
			actualizar_regiones();
    	}
    	else{
    		$('#carga_periodos').show();
    		actualizar_periodos();
    	}
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