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
    return view('homepage');
});

Route::get('/homepage', 'HomeController@index')->name('homepage');

Route::get('/hero/{slug}', 'HeroController@show')->name('show slug');

Route::get('/hero/index', 'HeroController@index')->name('index');

//Last question
Route::get('/hero/new', 'HeroController@create');

Auth::routes();
