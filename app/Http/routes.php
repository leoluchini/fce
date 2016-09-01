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

Route::get('/home', 'HomeController@index');

Route::resource('lectura', 'LecturaController');
Route::resource('categorias','CategoriaController');

Route::resource('categoria.publicaciones','PublicacionController');
Route::get('publicaciones/ver_archivo/{publicacion}', 'PublicacionController@ver_archivo');
Route::get('publicaciones/descargar_archivo/{publicacion}', 'PublicacionController@descargar_archivo');

Route::resource('unidades','UnidadController');
Route::resource('frecuencias','FrecuenciaController');
Route::resource('fuentes','FuenteController');
Route::resource('zonas','ZonaGeograficaController', ['except' => ['destroy', 'edit']]);
Route::delete('zonas/{tipo}/{id}','ZonaGeograficaController@destroy');
Route::get('zonas/{tipo}/{id}/edit','ZonaGeograficaController@edit');

Route::get('frontend/publicaciones', 'PublicoController@publicaciones');
Route::get('frontend/variables', 'PublicoController@variables');
Route::get('frontend/indicadores', 'PublicoController@indicadores');

Route::resource('categorias_variables','CategoriaVariableController');
Route::get('categorias_variables/create_sub_categoria/{categoria}','CategoriaVariableController@create_sub');
Route::resource('categoria.variables','VariableController');