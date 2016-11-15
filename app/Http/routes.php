<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['prefix' => 'administracion', 'middleware' => ['auth'] ], function()
{
	Route::get('/',  [ 'as' => 'administracion.index', 'uses' => 'AdministracionController@index' ]);
	//lectura de variables
	Route::get('lectura/lote/{lote}/datos', 'LecturaController@datos_lote');
	Route::get('lectura/lote/{lote}/aceptar',  [ 'as' => 'administracion.lectura.lote.aceptar', 'uses' => 'LecturaController@cambiar_estado' ]);
	Route::get('lectura/lote/{lote}/desactivar',  [ 'as' => 'administracion.lectura.lote.desactivar', 'uses' => 'LecturaController@cambiar_estado' ]);
	Route::resource('lectura', 'LecturaController');
	//lectura de indicadores
	Route::get('lectura_indicador/lote/{lote}/datos', 'LecturaIndicadorController@datos_lote');
	Route::get('lectura_indicador/lote/{lote}/aceptar',  [ 'as' => 'administracion.lectura_indicador.lote.aceptar', 'uses' => 'LecturaIndicadorController@cambiar_estado' ]);
	Route::get('lectura_indicador/lote/{lote}/desactivar',  [ 'as' => 'administracion.lectura_indicador.lote.desactivar', 'uses' => 'LecturaIndicadorController@cambiar_estado' ]);
	Route::resource('lectura_indicador', 'LecturaIndicadorController');

	Route::group(['middleware' => ['level:2'] ], function()
	{
		Route::resource('categorias','CategoriaController');
		Route::resource('categoria.publicaciones','PublicacionController');
		Route::resource('categorias_variables','CategoriaVariableController');
		Route::get('categorias_variables/create_sub_categoria/{categoria}','CategoriaVariableController@create_sub');
		Route::resource('categoria.variables','VariableController');
		Route::get('variables/agrupadas','VariableController@temas');
		Route::get('variables/busquedas_sin_resultados','VariableController@busquedas');
		Route::resource('frecuencias','FrecuenciaController');
		Route::resource('fuentes_informacion','FuenteController');
		Route::resource('unidades','UnidadController');
		Route::resource('zonas','ZonaGeograficaController', ['except' => ['destroy', 'edit']]);
		Route::delete('zonas/{tipo}/{id}','ZonaGeograficaController@destroy');
		Route::get('zonas/{tipo}/{id}/edit','ZonaGeograficaController@edit');
		Route::resource('categorias_indicadores','CategoriaIndicadorController');
		Route::get('categorias_indicadores/create_sub_categoria/{categoria}','CategoriaIndicadorController@create_sub');
		Route::resource('categoria.indicadores','IndicadorController');
		Route::get('indicadores/agrupadas','IndicadorController@temas');
		Route::get('indicadores/busquedas_sin_resultados','IndicadorController@busquedas');
	});

	Route::group(['middleware' => ['level:3'] ], function()
	{
		Route::resource('usuarios','UserController',['except' => ['show']]);
	});
});
Route::get('publicaciones/ver_archivo/{publicacion}', 'PublicacionController@ver_archivo');
Route::get('publicaciones/descargar_archivo/{publicacion}', 'PublicacionController@descargar_archivo');

Route::get('/home', 'HomeController@index');
//publicaciones
Route::match(array('GET', 'POST'), "publicaciones", array(
    'uses' => 'FrontendPublicacionesController@publicaciones',
));
//variables
Route::match(array('GET', 'POST'), "variables", array(
    'uses' => 'FrontendVariablesController@variables',
));
Route::post('excel_variables', 'FrontendVariablesController@descarga_variables_excel');
Route::post('consulta_variables', 'FrontendVariablesController@consulta_variables');
Route::get('consulta_regiones/{variables}', 'FrontendVariablesController@consulta_regiones');
Route::post('resultados_variables', 'FrontendVariablesController@resultados_variables');
Route::post('consulta_periodos', 'FrontendVariablesController@consulta_periodos');
Route::post('consulta_frecuencias', 'FrontendVariablesController@consulta_frecuencias');
//indicadores
Route::get('indicadores', 'FrontendIndicadoresController@indicadores');