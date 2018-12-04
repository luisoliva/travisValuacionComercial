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
    return view('welcome');
});

Route::get('/Calculadora', 'ValuadoraController@Calculadora');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('Calculate',array(
    'uses' => 'ValuadoraController@Calculate',
    'as' => 'user.Calculate'
));
Route::get('/GenerarPDF',array(
    'uses' => 'ValuadoraController@GenerarPDF',
    'as' => 'user.Descargar'
));