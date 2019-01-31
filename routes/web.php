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

Route::get('/index', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/post', 'PostController@post')->name('post');
Route::get('/category', 'PostController@category')->name('category');
Route::post('/newCategory', 'CategoryController@newCategory');
Route::post('/newProfile', 'ProfileController@newProfile');
Route::post('/newPost', 'PostController@newPost');
Route::get('/view/{id}', 'PostController@view');
Route::get('/edit/{id}', 'PostController@edit');
Route::get('/delete/{id}', 'PostController@delete');
Route::post('/editPost/{id}', 'PostController@editPost');

Auth::routes();
