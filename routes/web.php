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

Route::post('/comment/{id}', 'PostController@comment')->middleware('auth');
Route::get('/like/{id}', 'PostController@like')->middleware('auth');
Route::post('/search', 'PostController@search');
Route::get('/dislike/{id}', 'PostController@dislike');
Route::get('/category/{id}', 'PostController@categoryChange');
Route::get('/index', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profile');
Route::get('/post', 'PostController@post')->name('post')->middleware('auth');
Route::get('/category', 'PostController@category')->name('category');
Route::post('/newCategory', 'CategoryController@newCategory')->middleware('auth');
Route::post('/newProfile', 'ProfileController@newProfile')->middleware('auth');
Route::post('/newPost', 'PostController@newPost')->middleware('auth');
Route::get('/view/{id}', 'PostController@view')->middleware('auth');
Route::get('/edit/{id}', 'PostController@edit')->middleware('auth');
Route::get('/delete/{id}', 'PostController@delete')->middleware('auth');
Route::post('/editPost/{id}', 'PostController@editPost')->middleware('auth');
Route::get('/delete/{id}', 'PostController@delete')->middleware('auth');

Auth::routes();
