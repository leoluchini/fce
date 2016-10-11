$(function(){
	$('a#reformular_consulta').on('click', function(){
		$('form#datos_consulta').submit();
	});
	
	$('a#descargar_excel').on('click', function(){
		if($('form#datos_excel').length == 0){
			form = $('form#datos_consulta').clone();
			form.prop('id', 'datos_excel');
			form.prop('target', '_blank');
			form.prop('action', form.data('urlexcel'));
			$('div#contenedor_forms').append(form);
		}
		$('form#datos_excel').submit();
	});
});