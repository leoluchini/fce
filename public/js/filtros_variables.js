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
			var filtro_region = $('div#panel-accordion-1').find('div.panelContent');
			var filtro_variable = $('div#panel-accordion-2').find('div.panelContent');
			$('div#panel-accordion-1').append(filtro_variable);
			$('div#panel-accordion-2').append(filtro_region);
		}
		else{
			var filtro_variable = $('div#panel-accordion-1').find('div.panelContent');
			var filtro_region = $('div#panel-accordion-2').find('div.panelContent');
			$('div#panel-accordion-1').append(filtro_region);
			$('div#panel-accordion-2').append(filtro_variable);
		}
	});

	/*
	$( "#variable" ).autocomplete({
		appendTo: '#div_lista_seleccion_autocompletar',
		//position: { my : "right top", at: "right bottom" },
		source: function (request, response) {
					var ruta = $('#variable').data('urlconsulta');
					texto = $('#variable').val().toLowerCase();
					texto = texto.replaceArray(["á", "é", "í", "ó", "ú"], ["a", "e", "i", "o", "u"]);
					//ruta = ruta.replace(":query:", $('#variable').val());
					ruta = ruta.replace(":query:", texto);
		           	$.ajax({
		            	url: ruta,
						type: 'GET',
						dataType: 'json',
						data: request,
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
			                        	label: value.value,
			                            value: value.value,
			                            key: value.key
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
		    				var tag = $($('#agregar_tag').html());
		    				var texto = (ui.item.label.length > 60) ? ui.item.label.substring(0, 60)+'...' : ui.item.label;
							tag.find('span[class="texto"]').html(texto);
							tag.find('span[class="texto"]').prop('title', ui.item.label);
							tag.find('input').prop('name', 'variable_id['+ui.item.key+']');
							tag.find('input').val(ui.item.key);
							$('#div_lista_tags').show();
							$('#lista_tags').append(tag);
							$( "#mensaje_seleccion" ).show( "fade", 700 ).hide( "fade", 700 );

							$('#recargar_anios').val('true');
							activar_span($('a#link_paso1').find("span"));
						}
					}
			},
		search: function(){$('#variable').addClass('image_background_loading');},
        open: function(){
        	$('#listo_seleccion').data('cerrar', '0');
        	$('#listo_seleccion').show();
        	$('#variable').removeClass('image_background_loading');
        	$('.ui-autocomplete').css('width', $('#variable').css('width'));
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
	*/
});