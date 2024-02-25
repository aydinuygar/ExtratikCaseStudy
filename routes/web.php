<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/patients', 'App\Http\Controllers\PatientController@index');
Route::get('/patient/add', 'App\Http\Controllers\PatientController@add');
Route::get('/patient/edit/{id}', 'App\Http\Controllers\PatientController@edit');
Route::get('/patient/delete/{id}', 'App\Http\Controllers\PatientController@delete');

Route::get('/patient/{id}', 'App\Http\Controllers\PatientController@show');

Route::post('/patient/save', 'App\Http\Controllers\PatientController@save');
Route::post('/check-idcard', 'App\Http\Controllers\PatientController@checkIdCard');


Route::get('/statistics', 'App\Http\Controllers\StatisticsController@index');

Route::get('/conditions', 'App\Http\Controllers\ConditionsController@index');
Route::get('/condition/{condition}', 'App\Http\Controllers\ConditionsController@show');