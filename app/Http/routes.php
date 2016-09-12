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

Route::group(['prefix' => 'administracion'], function()
{
	Route::resource('lectura', 'LecturaController');
	Route::resource('categorias','CategoriaController');

	Route::resource('categoria.publicaciones','PublicacionController');
	Route::get('publicaciones/ver_archivo/{publicacion}', 'PublicacionController@ver_archivo');
	Route::get('publicaciones/descargar_archivo/{publicacion}', 'PublicacionController@descargar_archivo');

	Route::resource('unidades','UnidadController');
	Route::resource('frecuencias','FrecuenciaController');
	Route::resource('fuentes_informacion','FuenteController');
	Route::resource('zonas','ZonaGeograficaController', ['except' => ['destroy', 'edit']]);
	Route::delete('zonas/{tipo}/{id}','ZonaGeograficaController@destroy');
	Route::get('zonas/{tipo}/{id}/edit','ZonaGeograficaController@edit');


	Route::resource('categorias_variables','CategoriaVariableController');
	Route::get('categorias_variables/create_sub_categoria/{categoria}','CategoriaVariableController@create_sub');
	Route::resource('categoria.variables','VariableController');

	Route::get('backend', 'AdministracionController@index');
});

Route::get('/home', 'HomeController@index');
Route::get('publicaciones', 'PublicoController@publicaciones');
Route::get('variables', 'PublicoController@variables');
Route::get('indicadores', 'PublicoController@indicadores');
Route::post('resultados_variables', 'PublicoController@resultados_variables');