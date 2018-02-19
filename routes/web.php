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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('completar-cadastro', [
    'middleware' => 'auth',
    'as' => 'completeRegistration',
    'uses' => 'Auth\CompleteRegistrationController@create'
]);

Route::post('completar-cadastro', [
    'middleware' => 'auth',
    'as' => 'completeRegistration',
    'uses' => 'Auth\CompleteRegistrationController@store'
]);