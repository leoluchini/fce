function generar_div_grafico_linea(ancho, variable, categorias, serie, prefijo)
{
	var div = $('<div></div>');
	div.prop('id', prefijo+'_'+variable.id+'_linea');
	div.highcharts({
		chart: {
			width: ancho
		},
		title: {
            text: variable.descripcion,
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: ...',
            x: -20
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            title: {
                text: variable.unidad
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: serie,
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Exportar en PNG',
                        onclick: function () {
                            this.exportChart({
					            filename: 'grafico'
					        });
                        }
                    }, {
                        text: 'Exportar en PDF',
                        onclick: function () {
                            this.exportChart({
					            type: 'application/pdf',
					            filename: 'grafico'
					        });
                        },
                        separator: false
                    }]
                }
            }
        }
    });
	return div;
}
function generar_div_grafico_radar(ancho, variable, categorias, serie, prefijo)
{
	var div = $('<div></div>');
	div.prop('id', prefijo+'_'+variable.id+'_radar');
	div.highcharts({
        chart: {
            polar: true,
            type: 'line',
            width: ancho
        },
        
        title: {
            text: variable.descripcion,
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: ...',
            x: -20
        },
        
        pane: {
            size: '100%'
        },
        
        xAxis: {
            categories: categorias,
            tickmarkPlacement: 'on',
            lineWidth: 0
        },
            
        yAxis: {
        	title: {
                text: variable.unidad
            },
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },
        
        tooltip: {
            shared: true,
            valuePrefix: ''
        },
        
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 100,
            layout: 'vertical'
        },
        
        series: serie,

        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Exportar en PNG',
                        onclick: function () {
                            this.exportChart({
					            filename: 'grafico'
					        });
                        }
                    }, {
                        text: 'Exportar en PDF',
                        onclick: function () {
                            this.exportChart({
					            type: 'application/pdf',
					            filename: 'grafico'
					        });
                        },
                        separator: false
                    }]
                }
            }
        }
    });
    return div;
}
function generar_div_grafico_columna(ancho, variable, categorias, serie, prefijo, promedio)
{
	var div = $('<div></div>');
	div.prop('id', prefijo+'_'+variable.id+'_columna');

	var info_serie = serie.slice(0);
	for(var i = 0; i < info_serie.length; i++)
	{
		info_serie[i]['type'] = 'column';
	}
	var prom = [];
	prom['data'] = promedio;
	prom['type'] = 'spline',
    prom['name'] = 'Promedio';
    prom['marker'] = {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            };
    info_serie.push(prom);

	div.highcharts({
		chart: {
			width: ancho
		},
        title: {
            text: variable.descripcion,
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: ...',
            x: -20
        },
        xAxis: {
            categories: categorias
        },
        labels: {
            items: [{
                html: variable.unidad,
                style: {
                    left: '50px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        series: info_serie,

        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Exportar en PNG',
                        onclick: function () {
                            this.exportChart({
					            filename: 'grafico'
					        });
                        }
                    }, {
                        text: 'Exportar en PDF',
                        onclick: function () {
                            this.exportChart({
					            type: 'application/pdf',
					            filename: 'grafico'
					        });
                        },
                        separator: false
                    }]
                }
            }
        }
    });
	return div;
}
function generar_div_grafico_puntos(ancho, variable, categorias, serie, prefijo, max, min)
{
	var div = $('<div></div>');
	div.prop('id', prefijo+'_'+variable.id+'_puntos');

	var info_serie_puntos = serie.slice(0);
	for(var i = 0; i < info_serie_puntos.length; i++)
	{
		info_serie_puntos[i]['type'] = 'scatter';
		info_serie_puntos[i]['marker'] = {radius: 4};
	}
	var max_cat = categorias.length - 1;
	var linea = [];
	linea['type'] = 'line';
    //linea['name'] = 'Regression Line';
    linea['showInLegend'] = false;
    linea['data'] = [[0, min], [max_cat, max]];
    linea['marker'] = {enabled: false};
    linea['states'] = {hover: {lineWidth: 0}};
    linea['enableMouseTracking'] = false;
    info_serie_puntos.push(linea);
	div.highcharts({
		chart: {
			width: ancho
		},
        xAxis: {
            categories: categorias
        },
        yAxis: {
            min: 0,
        	title: {
                text: variable.unidad
            }
        },
        title: {
            text: variable.descripcion,
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: ...',
            x: -20
        },
        series: info_serie_puntos,
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Exportar en PNG',
                        onclick: function () {
                            this.exportChart({
					            filename: 'grafico'
					        });
                        }
                    }, {
                        text: 'Exportar en PDF',
                        onclick: function () {
                            this.exportChart({
					            type: 'application/pdf',
					            filename: 'grafico'
					        });
                        },
                        separator: false
                    }]
                }
            }
        }
	});
	return div;
}
function generar_div_grafico_linea_multieje(ancho, variable, categorias, serie, prefijo)
{
    var div = $('<div></div>');
    div.prop('id', prefijo+'_'+variable.id+'_lineamultieje');

    var ejes = [];
    var info_serie = [];
    var opuesto = false;
    for(var i = 0; i < serie.length; i++)
    {
        var eje =   {
                        gridLineWidth: 0,
                        title: {
                            text: serie[i]['variable'].unidad,
                            style: {
                                color: Highcharts.getOptions().colors[i]
                            }
                        },
                        labels: {
                            style: {
                                color: Highcharts.getOptions().colors[i]
                            }
                        },
                        opposite: opuesto
                    };
        ejes.push(eje);
        serie[i]['info']['yAxis'] = i;
        info_serie.push(serie[i]['info']);
        opuesto = opuesto ? false : true;
    }

    div.highcharts({
        chart: {
            zoomType: 'xy',
            width: ancho,
        },
        title: {
            text: variable.descripcion,
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: ...',
            x: -20
        },
        xAxis: [{
            categories: categorias,
            crosshair: true
        }],
        yAxis: ejes,
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 80,
            verticalAlign: 'top',
            y: 55,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: info_serie,
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: [{
                        text: 'Exportar en PNG',
                        onclick: function () {
                            this.exportChart({
                                filename: 'grafico'
                            });
                        }
                    }, {
                        text: 'Exportar en PDF',
                        onclick: function () {
                            this.exportChart({
                                type: 'application/pdf',
                                filename: 'grafico'
                            });
                        },
                        separator: false
                    }]
                }
            }
        }
    });

    return div;
}