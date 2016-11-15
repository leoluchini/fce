$(function(){
	$('a#reformular_consulta').on('click', function(){
		$('form#datos_consulta').submit();
	});
	
	$('a.transponer_pivot').on('click', function(e){
		e.preventDefault();
		var tab = '#'+$(this).data('tablaid');
		$(tab).DataTable().destroy();
		transponer_tabla($(tab));
		$(tab).DataTable(data_tables_global_config);
	});

    $('input[name="tablas_p"]').on('change', function(){
        refresh_check_tablas();
        $('#div_tablas_pivot_indicadores').hide();
        $('#div_tablas_pivot_regiones').hide();
        $('#div_tablas_pivot_frecuencias').hide();
        $('#div_tablas_pivot_'+$(this).val()).show();
    });
});

function transponer_tabla(tabla)
{
    var newrows = [];
    tabla.find("tr").each(function(){
        var i = 0;
        if($(this).parent().is('thead')){
        	$(this).find("th").each(function(){
                i++;
                if(i != 1){
                    if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                    newrows[i].append('<td>'+$(this).html()+'</td>');
                }
                else{
                    if(newrows[i] === undefined) { newrows[i] = $('<tr class="azul_FCE_bg blanco"></tr>'); }
                	newrows[i].append('<th >'+$(this).html()+'</th>');
                }
            });
        }
        else{
            $(this).find("td").each(function(){
                i++;
                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                if(i == 1){
                	newrows[i].append('<th class="text-right">'+$(this).html()+'</th>');
                }
                else{
                	newrows[i].append('<td class="text-right">'+$(this).html()+'</td>');
                }
            });
        }
    });
    tabla.empty();
    tabla.append($("<thead></thead>"));
    tabla.append($("<tbody></tbody>"));
    
    $.each(newrows, function(){
    	tabla.find('tbody').append(this);
    });
    tabla.find('thead').append(tabla.find("tbody").find('tr').first());
}

function refresh_check_tablas()
{
  $('input[name="tablas_p"]:checked').parent().find('h4').removeClass().addClass('azul_FCE');
  $('input[name="tablas_p"]:checked').parent().find('span').removeClass().addClass('icon-check-1');
  var id_check = $('input[name="tablas_p"]:checked').prop('id')
  $('input[name="tablas_p"]').each(function(){
    if($(this).prop('id') != id_check){
      $(this).parent().find('h4').removeClass().addClass('azul_FCE_apagado');
      $(this).parent().find('span').removeClass().addClass('icon-check-empty');
    }
  });
}