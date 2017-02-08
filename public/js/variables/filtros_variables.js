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
			$('#activar_cascada').hide();
			$('#desactivar_cascada').hide();
			$('#filtro_cascada').prop('checked', false);
			$('#filtro_cascada').trigger('change');
		}
		else{
			var filtro_variable = $('div#panel-accordion-1').find('div.panelContent');
			var filtro_region = $('div#panel-accordion-2').find('div.panelContent');
			$('div#panel-accordion-1').append(filtro_region);
			$('div#panel-accordion-2').append(filtro_variable);
			filtro_variable.find('#var_reg').hide();
			filtro_variable.find('#reg_var').show();
			//$('#div_filtro_cascada').show();
			$('#desactivar_cascada').show();
			$('#filtro_cascada').prop('checked', true);
			$('#filtro_cascada').trigger('change');
		}
		limpiar_variables_regiones();
	});

	
	$( "#variable" ).autocomplete({
		delay: 600,
		appendTo: '#div_lista_seleccion_autocompletar',
		position: { my : "left bottom", at: "left top" },
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
					$( "#variable" ).data('close', 'false');
    				if(ui.item.key != 0)
    				{
    					agregar_tag_variable(ui.item.key, ui.item.label);
					}
			},
		search: function(){$('#variable').addClass('image_background_loading');},
        open: function(){
        	$('#variable').removeClass('image_background_loading');
        },
        close: function (event, ui) {
        	if($( "#variable" ).data('close') == 'false'){
        		$( "#variable" ).data('close', 'true');
        		if (!$("ul.ui-autocomplete").is(":visible")) {
		            $("ul.ui-autocomplete").show();
		        }
        	}
        	else{
	        	$('#variable').val('');
	        	if($('input[name="tipo_busqueda"]:checked').val() == 'variable_region'){
					actualizar_regiones();
	        	}
	        	else{
	        		actualizar_periodos();
	        	}
        	}
	    },
	});
	$(document).on("click", "a[class*='mb-tag-remove']", function(e) {
		e.preventDefault();
		$(this).parent().remove();

		if($('input[name="tipo_busqueda"]:checked').val() == 'variable_region'){
			if($('#lista_tags').find('input[name^="variable_id"]').length == 0){
				reset_regiones();
				fijar_busqueda_multiselect();
			}
			else{
				actualizar_regiones();
			}
		}
	});

	$('#pais, #provincia, #municipio').on('change', function(){
		if(!marca_actulizacion_periodos && ($('input[name="tipo_busqueda"]:checked').val() == 'variable_region')){
			marca_actulizacion_periodos = true;
			setTimeout(function(){
				marca_actulizacion_periodos = false;
				$('#carga_periodos').show();
				actualizar_periodos();
			}, 1500);
		}
		if($('#filtro_cascada').is(':checked')){
			if(($(this).prop('id') == 'pais')||($(this).prop('id') == 'provincia')){
				var select = '';
				if($(this).prop('id') == 'pais'){
					select =  'select#provincia';
					reset_select_with_list($('select#provincia'), $('#listado_provincias'));
				}
				else{
					select =  'select#municipio';
					reset_select_with_list($('select#municipio'), $('#listado_municipios'));
				}
				seleccionados = [];
				$(this).find('option:selected').each(function(){
					seleccionados.push(+$(this).val());
				});
				filtrar_region(seleccionados, select);
			}
		}
	});
	$('#periodo').on('change', function(){
		if(!marca_actulizacion_frecuencias){
			marca_actulizacion_frecuencias = true;
			setTimeout(function(){
				marca_actulizacion_frecuencias = false;
				$('#carga_frecuencias').show();
				actualizar_frecuencias();
			}, 1500);
		}
	});

	$('#consulta_variables').submit(function() {
		isValid = true;
		errores = '<h4>Debe completar los 4 pasos del formulario para poder realizar la consulta.</h4>';
		if($('#lista_tags').find('input[name^="variable_id"]').length == 0){
			isValid = false;
			errores += '<p>Le faltan completar los siguientes pasos:</p>';
		}
		if($('#'+$('input[name="tipo_zona"]').val()).find('option:selected').length == 0){
			isValid = false;
			errores += '<p>Paso 2: Region</p>';
		}
		if($('select#periodo').find('option:selected').length == 0){
			isValid = false;
			errores += '<p>Paso 3: Período</p>';
		}
		if(($('#tipo_frecuencia').val() != 'anual')&&($('#'+$('input[name="tipo_frecuencia"]').val()).find('option:selected').length == 0)){
			isValid = false;
			errores += '<p>Paso 4: Frecuencia</p>';
		}
		if(!isValid){
			$('#generic_modal').find('#myModalLabel').empty().append('<span class="icon-info-circled-alt"></span>Formulario incompleto');
			$('#generic_modal').find('.modal-body').empty().append(errores);
			$('#generic_modal').find('.modal-footer').empty();
			
			$('#generic_modal').modal('show');
		}
	    return isValid;
	});

	$(document).on("click", "a[class*='ver_variables_relacionadas']", function(e) {
		e.preventDefault();
		span = $(this).prev();
		input = $(this).next();
		enlace = $('#arbol_temas_variables').find('a[class="selector_variable"][data-id="'+input.val()+'"]');
		lista = enlace.closest('ul');
		label = lista.prev();

		$('#generic_modal').find('#myModalLabel').empty().append('<span class="icon-info-circled-alt"></span>Variables relacionadas a "'+span.attr('title')+'" por el tema "'+label.text()+'"');
		$('#generic_modal').find('.modal-body').empty().append(lista.clone().css({'display':'block','max-height':'250px','overflow':'auto'}));
		$('#generic_modal').find('.modal-footer').empty();
		$('#generic_modal').modal('show');
	});

	$('#activar_cascada').on('click', function(e){
		e.preventDefault();
		$(this).hide();
		$('#desactivar_cascada').show();
		$('#filtro_cascada').prop('checked', true);
		$('#filtro_cascada').trigger('change');
	});
	$('#desactivar_cascada').on('click', function(e){
		e.preventDefault();
		$(this).hide();
		$('#activar_cascada').show();
		$('#filtro_cascada').prop('checked', false);
		$('#filtro_cascada').trigger('change');
	});
	$('#filtro_cascada').on('change', function(){
		if($(this).is(':checked')){
			$('span.icono_filtro_cascada').show();
		}
		else{
			$('span.icono_filtro_cascada').hide();
		}
		reset_regiones();
	});

	$(window).load(function(e) {
		reset_regiones();
		reset_select_with_list($('select#periodo'), $('#listado_periodos'));
		if (typeof consulta !== 'undefined') {
			cargar_consulta_previa();
		}
		fijar_busqueda_multiselect();
	});
});

var actualizando_regiones = false;
function actualizar_regiones(callback)
{
	if(!actualizando_regiones){
		actualizando_regiones = true;
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
						fijar_busqueda_multiselect();
						if (typeof callback !== 'undefined') { callback(); }
						actualizando_regiones = false;
					},
				});
			}
		}
		actualizando_regiones = false;
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
	reset_select_with_list($('select#pais'), $('#listado_paises'));
	reset_select_with_list($('select#provincia'), $('#listado_provincias'));
	reset_select_with_list($('select#municipio'), $('#listado_municipios'));
	$('a[href="#div_pais"]').trigger('click');
}
function reset_select_with_list(select, listado)
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
	reset_select_with_list($('select#periodo'), $('#listado_periodos'));
	fijar_busqueda_multiselect();
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
var marca_actulizacion_periodos = false;
var actualizando_periodos = false;
function actualizar_periodos(callback)
{
	if(!actualizando_periodos){
		actualizando_periodos = true;
		var variables = [];
		$('#lista_tags').find('input[name^="variable_id"]').each(function(){
			variables.push($(this).val()); 
		});
		var zonas = [];
		$('#'+$('input[name="tipo_zona"]').val()).find('option:selected').each(function(){ 
			zonas.push($(this).val()); 
		});
		datos = {regiones: zonas,
				 variables: variables,
				 _token: $( "#variable" ).data('token')};
		if((variables.length > 0)&&(zonas.length > 0)){
			$.ajax({
	        	url: $('#periodo').data('urlconsulta'),
				type: 'POST',
				dataType: 'json',
				data: datos,
				success: function (data) {

					$('#periodo').multiselect('disable');
					$('#periodo').find('option').remove();
					if(data.length > 0)
					{
						$.each(data, function(key, value) {
							$('#periodo').append('<option value="'+value+'" > '+value+' </option>');
						});
					}
					else{
						$('#periodo').append('<option value="0" disabled> No existe informacion para la combinacion de variables/regiones seleccionadas </option>');
					}

					$('#periodo').multiselect('rebuild');
					$('#periodo').multiselect('refresh');
					$('#periodo').multiselect('enable');
					fijar_busqueda_multiselect();
					if (typeof callback !== 'undefined') { callback(); }
					actualizando_periodos = false;
	           	}
	       	});
		}
		$('#carga_periodos').hide();
		actualizando_periodos = false;
	}
}


var marca_actulizacion_frecuencias = false;
var actualizando_frecuencias = false;
function actualizar_frecuencias(callback)
{
	if(!actualizando_frecuencias){
		actualizando_frecuencias = true;
		var variables = [];
		$('#lista_tags').find('input[name^="variable_id"]').each(function(){
			variables.push($(this).val()); 
		});
		var zonas = [];
		$('#'+$('input[name="tipo_zona"]').val()).find('option:selected').each(function(){ 
			zonas.push($(this).val()); 
		});
		var periodos = [];
		$('#periodo').find('option:selected').each(function(){ 
			periodos.push($(this).val()); 
		});
		datos = {regiones: zonas,
				 variables: variables,
				 periodos: periodos,
				 _token: $( "#variable" ).data('token')};
		if((variables.length > 0)&&(zonas.length > 0)&&(periodos.length > 0)){
			$.ajax({
	        	url: $('#periodo').data('consultafrec'),
				type: 'POST',
				dataType: 'json',
				data: datos,
				success: function (data) {
					if(data['frecuencias'].indexOf(1) !== -1){
						$('#frec_anual_ok').show();
						$('#frec_anual_no').hide();
					}
					else{
						$('#frec_anual_no').show();
						$('#frec_anual_ok').hide();	
					}
					check_frecuencias($('#semestral'), data['frecuencias']);
					check_frecuencias($('#trimestral'), data['frecuencias']);
					check_frecuencias($('#mensual'), data['frecuencias']);
					if (typeof callback !== 'undefined') { callback(); }
					actualizando_frecuencias = false;
	           	}
	       	});
		}
		$('#carga_frecuencias').hide();
		actualizando_frecuencias = false;
	}
}
function check_frecuencias(select, datos)
{
	select.multiselect('disable');
	num_options = select.find('option').length;
	$.each(select.find('option'), function() {
		valor = $(this).val();
		if(datos.indexOf(+valor) !== -1){
			$(this).removeAttr("disabled")
		}
		else{
			$(this).attr('disabled', 'disabled');
		}
		if(! --num_options){
			if(select.find('option:enabled').length > 0){
				$('#frec_'+select.prop('id')+'_ok').show();
				$('#frec_'+select.prop('id')+'_no').hide();
			}
			else{
				$('#frec_'+select.prop('id')+'_no').show();
				$('#frec_'+select.prop('id')+'_ok').hide();
			}
			select.multiselect('rebuild');
			select.multiselect('refresh');
			select.multiselect('enable');
		}
	});
}

function cargar_consulta_previa()
{
	//$('#espera_carga_previa').show();
	//carga tipo de busqueda
	if(consulta.tipo_busqueda == 'variable_region'){
		$('#busqueda_option2').prop('checked', true);
		$('#busqueda_option2').trigger('change');
		carga_previa_variables();
	}
	else{
		carga_previa_regiones();
	}
}
function carga_previa_variables()
{
 	//carga de variables
	var num_var = $.map(consulta.variable_id, function(el) { return el }).length;
	$.each(consulta.variable_id, function(key, value) {
		var tag = $($('#agregar_variable').html());
		var texto = (consulta.variable_name[value].length > 60) ? consulta.variable_name[value].substring(0, 60)+'...' : consulta.variable_name[value];
		tag.find('span[class="texto"]').html(texto);
		tag.find('span[class="texto"]').prop('title', consulta.variable_name[value]);
		tag.find('input').prop('name', 'variable_id['+value+']');
		tag.find('input').val(value);
		$('#lista_tags').append(tag);
		if(! --num_var){
			if(consulta.tipo_busqueda == 'variable_region'){
				actualizar_regiones(carga_previa_regiones);
			}
			else{
				//llamo a actualizar los periodos y cargarlos
				actualizar_periodos(carga_previa_anios);
			}
		}
	});
}
function carga_previa_regiones()
{
	//carga de regiones
	var num_regiones = $.map(consulta.regiones, function(el) { return el }).length;
	$('#'+consulta.tipo_zona).multiselect('disable');
	$.each(consulta.regiones, function(key, value) {
		$('#'+consulta.tipo_zona).find('option[value="'+value+'"]').prop('selected', true);
		if(! --num_regiones){
			$('#'+consulta.tipo_zona).multiselect('refresh');
			$('#'+consulta.tipo_zona).multiselect('enable');
			fijar_busqueda_multiselect();
			$('a[href="#div_'+consulta.tipo_zona+'"]').click();
			if(consulta.tipo_busqueda == 'region_variable'){
				carga_previa_variables();
			}
			else{
				//llamo a actualizar los periodos y cargarlos
				actualizar_periodos(carga_previa_anios);
			}
		}
	});
}
function carga_previa_anios()
{
	var num_anios = $.map(consulta.periodo, function(el) { return el }).length;
	$('select#periodo').multiselect('disable');
	$.each(consulta.periodo, function(key, value) {
		$('#periodo').find('option[value="'+value+'"]').prop('selected', true);
		if(! --num_anios){
			$('select#periodo').multiselect('refresh');
			$('select#periodo').multiselect('enable');
			fijar_busqueda_multiselect();
		}
	});
	actualizar_frecuencias(carga_previa_frecuencia);
	//carga_previa_frecuencia();
}
function carga_previa_frecuencia()
{
	if(consulta.tipo_frecuencia != 'anios'){
		var num_frecuencias = $.map(consulta.frecuencias, function(el) { return el }).length;
		$('#'+consulta.tipo_frecuencia).multiselect('disable');
		$.each(consulta.frecuencias, function(key, value) {
			$('#'+consulta.tipo_frecuencia).find('option[value="'+value+'"]').prop('selected', true);
			if(! --num_frecuencias){
				$('#'+consulta.tipo_frecuencia).multiselect('refresh');
				$('#'+consulta.tipo_frecuencia).multiselect('enable');
				fijar_busqueda_multiselect();
				$('a[href="#div_'+consulta.tipo_frecuencia+'"]').click();
			}
		});
	}
	$('#div_paso_1').click();
	setTimeout(function(){
		$('#div_titulo_busqueda').show();
		$('#div_pagina').show();
		$('#espera_carga_previa').hide();
	}, 500);
}

function agregar_tag_variable(id, nombre)
{
	if($('#lista_tags').find('input[name="variable_id['+id+']"]').length == 0){
		var tag = $($('#agregar_variable').html());
		var texto = (nombre.length > 60) ? nombre.substring(0, 60)+'...' : nombre;
		tag.find('span[class="texto"]').html(texto);
		tag.find('span[class="texto"]').prop('title', nombre);
		tag.find('input').prop('name', 'variable_id['+id+']');
		tag.find('input').val(id);
		$('#lista_tags').append(tag);
		$("#tilde_variable_agregada").fadeIn(400).fadeOut(400);
	}
}

function fijar_busqueda_multiselect()
{
	$(document).find('ul.list_fixed_search').each(function(){
		if($(this).find('div[class="options-wrapper"]').length == 0){
			$(this).find('li:not(.filter)').wrapAll('<div class="options-wrapper"></div>');
		}
	});
}

function filtrar_region(padres, select)
{
	$(select).multiselect('disable');
	$(select).find('option').each(function(){
		if(padres.indexOf(+$(this).data('padreid')) == -1){
			$(this).remove();
		}
	});
	$(select).multiselect('rebuild');
	$(select).multiselect('refresh');
	$(select).multiselect('enable');
	fijar_busqueda_multiselect();
}