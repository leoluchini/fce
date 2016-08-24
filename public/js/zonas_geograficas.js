$(function(){
	$('select[name="tipo"]').on('change', function(){
		$('#select_paises').hide();
		$('#select_provincias').hide();
		if($(this).val() == 'pais'){
			$('select[name="paises"]').val('');
			$('select[name="provincias"]').val('');
		}
		if($(this).val() == 'provincia'){
			$('#select_paises').show();
			$('select[name="provincias"]').val('');
		}
		if($(this).val() == 'municipio'){
			$('#select_provincias').show();
			$('select[name="paises"]').val('');
		}
	});
	$('select[name="provincias"], select[name="paises"]').on('change', function(){
		$('input[name="zona_padre_id"]').val($(this).val());
	});
});