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

	$('a.transponer_pivot').on('click', function(e){
		e.preventDefault();
		var tab = '#'+$(this).data('tablaid');
		$(tab).DataTable().destroy();
		transponer_tabla($(tab));
		$(tab).DataTable(data_tables_global_config);
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
                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                if(i != 1){
                	newrows[i].append('<td>'+$(this).html()+'</td>');
                }
                else{
                	newrows[i].append('<th class="azul_FCE_bg blanco">'+$(this).html()+'</th>');
                }
            });
        }
        else{
            $(this).find("td").each(function(){
                i++;
                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                if(i == 1){
                	newrows[i].append('<th class="azul_FCE_bg blanco">'+$(this).html()+'</th>');
                }
                else{
                	newrows[i].append('<td>'+$(this).html()+'</td>');
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