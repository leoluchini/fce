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
});