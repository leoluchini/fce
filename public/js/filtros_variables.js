$(function(){
	$('input[name="tipo_zona"]').on('change', function(){
		$('div#pais').hide();
		$('div#provincia').hide();
		$('div#municipio').hide();
		$('div#'+$(this).val()).show();
	});
	$('input[name="tipo_frecuencia"]').on('change', function(){
		$('div#semestral').hide();
		$('div#trimestral').hide();
		$('div#mensual').hide();
		if($(this).val() != 'anual'){
			$('div#'+$(this).val()).show();
		}
	});
	$('input[name="tipo_busqueda"]').on('change', function(){
		if($(this).val() == 'variable_region'){
			var filtro_region = $('div#panel-accordion-1').find('div.panelContent').clone();
			var filtro_variable = $('div#panel-accordion-2').find('div.panelContent').clone();
		}
		else{
			var filtro_variable = $('div#panel-accordion-1').find('div.panelContent').clone();
			var filtro_region = $('div#panel-accordion-2').find('div.panelContent').clone();
		}
		var filtro_region = $('div#panel-accordion-1').find('div.panelContent').clone();
		var filtro_variable = $('div#panel-accordion-2').find('div.panelContent').clone();
		$('div#panel-accordion-1').find('div.panelContent').remove();
		$('div#panel-accordion-2').find('div.panelContent').remove();
		if($(this).val() == 'variable_region'){
			$('div#panel-accordion-1').append(filtro_variable);
			$('div#panel-accordion-2').append(filtro_region);
		}
		else{
			$('div#panel-accordion-1').append(filtro_region);
			$('div#panel-accordion-2').append(filtro_variable);
		}
	});
});