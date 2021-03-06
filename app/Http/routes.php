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

Route::get('/', 'IntroController@index');

// Gestion de eventos
Route::get('calendario{month?}/{year?}', 'EventController@index');
Route::post('calendario/add', 'EventController@addEvent');
Route::post('calendario/destroy', 'EventController@destroyEvent');
Route::post('calendario/update', 'EventController@updateEvent');
Route::post('calendario/resize', 'EventController@resizeEvent');
Route::post('calendario/edit', 'EventController@editEvent');
Route::post('calendario/horas', 'EventController@ajaxHoursMoth');

// Gestion de turnos
Route::post('calendario/turno', 'TurnosController@addTurno');
Route::post('turnos/delete', 'TurnosController@removeTurno');

// Gestion de profile
Route::post('perfil/update', 'ProfileController@updateProfile');

// Gestion de comentarios
Route::post('comment/store', 'CommentController@store');


// Rutas generales
Route::get('about', 'AboutController@index');
Route::get('perfil', 'ProfileController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);