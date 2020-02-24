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
Route::match(['get', 'post'] ,'/home', function () {
    echo ('welcome');
});

Route::get('/news/{id}/{name}', function ($id, $name) {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('registration.source');
});
