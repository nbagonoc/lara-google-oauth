<?php

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard'
]);

// OAUTH
Route::get('/login', [
    'uses' => 'Auth\RegisterController@redirectToProvider',
    'as' => 'login'
]);
Route::get('/auth/google/callback', [
    'uses' => 'Auth\RegisterController@handleProviderCallback',
    'as' => 'register'
]);
Route::post('logout', 'Auth\LoginController@logout')->name('logout');