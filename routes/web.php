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
<<<<<<< HEAD
    return view('public.index');
=======
    return view('public.index.page');
});

Route::get('/contact', function () {
    return view('public.contacts.page');
});

Route::get('/delivery', function () {
    return view('public.delivery.page');
>>>>>>> hw2
});
