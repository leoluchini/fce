$(document).ready(function () {
	$('#arbol_consulta').on('click', function(){
		$('#modal_consulta').modal('show');
	});
	$('label.tree-toggler').click(function () {
		$(this).parent().children('ul.tree').toggle(300);
	});
  	$('label.tree-toggler').parent().children('ul.tree').toggle(1000);
  	$('a.selector_variable').on('click', function(e){
  		e.preventDefault();
  		agregar_tag_variable($(this).data('id'), $(this).data('nombre'));
  	});
  	$('#modal_consulta').on('hidden.bs.modal', function () {
		actualizar_regiones();
	});
});