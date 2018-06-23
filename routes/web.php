<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'as' => 'completeRegistration'], function () {
    Route::get('completar-cadastro', 'Auth\CompleteRegistrationController@create');
    Route::post('completar-cadastro', 'Auth\CompleteRegistrationController@store');
});
