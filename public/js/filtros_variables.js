$(function(){
	String.prototype.replaceArray = function(find, replace) {
	  var replaceString = this;
	  for (var i = 0; i < find.length; i++) {
	    replaceString = replaceString.replace(find[i], replace[i]);
	  }
	  return replaceString;
	};
	$('li.solapa_zona').on('click', function(){
		$('input#tipo_zona').val($(this).data('region'));
	});
	$('li.solapa_frecuencia').on('click', function(){
		$('input#tipo_frecuencia').val($(this).data('frecuencia'));
	});
	$('input[name="tipo_busqueda"]').on('change', function(){
		switch_tipo_busqueda();
		if($(this).val() == 'variable_region'){
			var filtro_region = $('div#panel-accordion-1').find('div.panelContent');
			var filtro_variable = $('div#panel-accordion-2').find('div.panelContent');
			$('div#panel-accordion-1').append(filtro_variable);
			$('div#panel-accordion-2').append(filtro_region);
			filtro_variable.find('#var_reg').show();
			filtro_variable.find('#reg_var').hide();
		}
		else{
			var filtro_variable = $('div#panel-accordion-1').find('div.panelContent');
			var filtro_region = $('div#panel-accordion-2').find('div.panelContent');
			$('div#panel-accordion-1').append(filtro_region);
			$('div#panel-accordion-2').append(filtro_variable);
			filtro_variable.find('#var_reg').hide();
			filtro_variable.find('#reg_var').show();
		}
		limpiar_variables_regiones();
	});

	
	$( "#variable" ).autocomplete({
		source: function (request, response) {
					var ruta = $('#variable').data('urlconsulta');
					texto = $('#variable').val().toLowerCase();
					texto = texto.replaceArray(["á", "é", "í", "ó", "ú"], ["a", "e", "i", "o", "u"]);
					var zonas = [];
					$('#'+$('input[name="tipo_zona"]').val()).find('option:selected').each(function(){ 
						zonas.push($(this).val()); 
					});
					datos = { tipo_busqueda: $('input[name="tipo_busqueda"]:checked').val(),
							 tipo_zona: $('input[name="tipo_zona"]').val(),
							 regiones: zonas,
							 busqueda: texto,
							 _token: $( "#variable" ).data('token')};
		           	$.ajax({
		            	url: ruta,
						type: 'POST',
						dataType: 'json',
						data: datos,
						success: function (data) {
							if(data.length == 0)
							{
								response([{
		                        	label: 'La busqueda no produjo resultados',
		                        	value: 'La busqueda no produjo resultados',
		                            key: 0
		                        }]);
							}
							else
							{
			                	response($.map(data, function (value, key) { 
			                        return {
			                        	label: value.valor,
			                            value: value.valor,
			                            key: value.clave
			                        };
			                   	}));
		                	}
		               	}
		           	});
			},
		minLength: 3,
		select: function( event, ui ) {
					event.preventDefault();

    				if(ui.item.key != 0)
    				{
    					if($('#lista_tags').find('input[name="variable_id['+ui.item.key+']"]').length == 0){
		    				var tag = $($('#agregar_variable').html());
		    				var texto = (ui.item.label.length > 60) ? ui.item.label.substring(0, 60)+'...' : ui.item.label;
							tag.find('span[class="texto"]').html(texto);
							tag.find('span[class="texto"]').prop('title', ui.item.label);
							tag.find('input').prop('name', 'variable_id['+ui.item.key+']');
							tag.find('input').val(ui.item.key);
							$('#lista_tags').append(tag);
						}
					}
			},
		search: function(){$('#variable').addClass('image_background_loading');},
        open: function(){
        	$('#listo_seleccion').data('cerrar', '0');
        	$('#listo_seleccion').show();
        	$('#variable').removeClass('image_background_loading');
        },
        close: function (event, ui) {
        	if($('#listo_seleccion').data('cerrar') == 0){
		        if (!$("ul.ui-autocomplete").is(":visible")) {
		            $("ul.ui-autocomplete").show();
		        }
		    }
		    else{
		    	$('#listo_seleccion').hide();
		    }
	    },
	});
	$('#listo_seleccion').on('click', function(){
		cerrar_autocompletar();
	});
	$(document).on("click", "a[class*='mb-tag-remove']", function(e) {
		e.preventDefault();
		$(this).parent().remove();

		if($('#lista_tags').find('input[name^="variable_id"]').length == 0){
			reset_regiones();
		}
	});
	$('div.header').on('click', function(){
		if($('#listo_seleccion').data('cerrar') == 0){
			cerrar_autocompletar();
		}
	});

	$(window).load(function(e) {
		reset_regiones();
	});
});
function cerrar_autocompletar()
{
	$('#listo_seleccion').data('cerrar', '1');
	$('#variable').val('');
	$('#variable').autocomplete('close');
	actualizar_regiones();
}
function actualizar_regiones()
{
	if($('input[name="tipo_busqueda"]:checked').val() == 'variable_region')
	{
		var lista = '';
		$('#lista_tags').find('input[name^="variable_id"]').each(function(){
			lista = (lista == '')  ? lista + $(this).val() : lista + '-' + $(this).val();
		});
		if(lista != ''){
			var ruta = $('#variable').data('consultaregiones');
			ruta = ruta.replace(":query:", lista);
			$.ajax({
				url: ruta,
				type: 'GET',
				dataType: 'json',
				success: function (data) {
					update_region($('select#pais'), data.paises, 'No existen paises con informacion para las variables seleccionadas');
					update_region($('select#provincia'), data.provincias, 'No existen provincias con informacion para las variables seleccionadas');
					update_region($('select#municipio'), data.municipios, 'No existen municipios con informacion para las variables seleccionadas');
				},
			});
		}
	}
}
function update_region(select, datos, mensaje)
{
	select.multiselect('disable');
	select.find('option').remove();
	if(datos.length > 0)
	{
		$.each(datos, function(key, value) {
			select.append('<option value="'+value.id+'" > '+value.nombre+' </option>');
		});
	}
	else{
		select.append('<option value="0" disabled> '+mensaje+' </option>');
	}

	select.multiselect('rebuild');
	select.multiselect('refresh');
	select.multiselect('enable');
}
function reset_regiones()
{
	reset_region($('select#pais'), $('#listado_paises'));
	reset_region($('select#provincia'), $('#listado_provincias'));
	reset_region($('select#municipio'), $('#listado_municipios'));
}
function reset_region(select, listado)
{
	select.multiselect('disable');
	select.find('option').remove();
	select.append($(listado.html()));
	select.multiselect('rebuild');
	select.multiselect('refresh');
	select.multiselect('enable');
}
function limpiar_variables_regiones()
{
	$('#lista_tags').empty();
	reset_regiones();
	$('#div_paso_1').trigger('click');
}
function switch_tipo_busqueda()
{
	op1 = $('input#busqueda_option1').parent().find('h4');
	op2 = $('input#busqueda_option2').parent().find('h4');
	clase_h4 = op1.attr('class');
	clase_span = op1.find('span').attr('class');
	op1.removeClass().addClass(op2.attr('class'));
	op1.find('span').removeClass().addClass(op2.find('span').attr('class'));
	op2.removeClass().addClass(clase_h4);
	op2.find('span').removeClass().addClass(clase_span);
}