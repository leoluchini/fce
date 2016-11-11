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
	Route::get('lectura/lote/{lote}/datos', 'LecturaController@datos_lote');
	Route::get('lectura/lote/{lote}/aceptar',  [ 'as' => 'administracion.lectura.lote.aceptar', 'uses' => 'LecturaController@cambiar_estado' ]);
	Route::get('lectura/lote/{lote}/desactivar',  [ 'as' => 'administracion.lectura.lote.desactivar', 'uses' => 'LecturaController@cambiar_estado' ]);
	Route::resource('lectura', 'LecturaController');

	Route::group(['middleware' => ['level:2'] ], function()
	{
		Route::resource('categorias','CategoriaController');
		Route::resource('categoria.publicaciones','PublicacionController');
		Route::resource('categorias_variables','CategoriaVariableController');
		Route::get('categorias_variables/create_sub_categoria/{categoria}','CategoriaVariableController@create_sub');
		Route::resource('categoria.variables','VariableController');
		Route::resource('frecuencias','FrecuenciaController');
		Route::resource('fuentes_informacion','FuenteController');
		Route::resource('unidades','UnidadController');
		Route::resource('zonas','ZonaGeograficaController', ['except' => ['destroy', 'edit']]);
		Route::delete('zonas/{tipo}/{id}','ZonaGeograficaController@destroy');
		Route::get('zonas/{tipo}/{id}/edit','ZonaGeograficaController@edit');
		Route::get('variables/agrupadas','VariableController@temas');
		Route::get('variables/busquedas_sin_resultados','VariableController@busquedas');
	});

	Route::group(['middleware' => ['level:3'] ], function()
	{
		Route::resource('usuarios','UserController',['except' => ['show']]);
	});
});
Route::get('publicaciones/ver_archivo/{publicacion}', 'PublicacionController@ver_archivo');
Route::get('publicaciones/descargar_archivo/{publicacion}', 'PublicacionController@descargar_archivo');

Route::get('/home', 'HomeController@index');
Route::match(array('GET', 'POST'), "publicaciones", array(
    'uses' => 'PublicoController@publicaciones',
));
Route::get('indicadores', 'PublicoController@indicadores');
Route::match(array('GET', 'POST'), "variables", array(
    'uses' => 'PublicoController@variables',
));
Route::post('excel_variables', 'PublicoController@descarga_variables_excel');
Route::post('consulta_variables', 'PublicoController@consulta_variables');
Route::get('consulta_regiones/{variables}', 'PublicoController@consulta_regiones');
Route::post('resultados_variables', 'PublicoController@resultados_variables');
Route::post('consulta_periodos', 'PublicoController@consulta_periodos');
Route::post('consulta_frecuencias', 'PublicoController@consulta_frecuencias');