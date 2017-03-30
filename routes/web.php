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

Route::get('input/{word?}', 'ScrabbleController@show');

Route::get('/score', 'ScrabbleController@score');

# /routes/web.php
Route::get('/lookup', 'ScrabbleController@lookup');
/**
* Main homepage visitors see when they visit just /
*/
Route::get('/', 'HomeController');