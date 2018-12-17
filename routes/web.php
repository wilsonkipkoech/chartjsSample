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


Route::get('index','StockController@index');

//Route::get('/stocks','ChartController@index');

Route::get('/projects/chart/data', 'ChartController@renderChart');


Route::get('/chart','ChartController@getdata');


