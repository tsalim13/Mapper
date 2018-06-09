<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('edit', 'MarkersController');

Route::resource('client-edit', 'ClientsController');

Route::resource('map-client', 'LouersController');


Route::get('etat/{n}', 'EtatMarkerController@find')->where('n', '[0-9]+');