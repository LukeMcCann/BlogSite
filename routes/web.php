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

// Route::get('/', function () {
//     return view('pages.index');
// });

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/index', 'HomeController@index')->name('index');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/category', 'ProfileController@category')->name('category');

Auth::routes();
