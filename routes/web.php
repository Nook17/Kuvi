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
Route::get('/search', 'SearchController@users')->name('search');
Route::resource('/users', 'UsersController', ['except' => ['index', 'create', 'store', 'destroy']]); // except -> wykluczone metody
// Route::resource('/friends', 'FriendsController');
Route::get('/users/{user}/friends', 'FriendsController@index');
Route::post('/friends/{friend}', 'FriendsController@add');
Route::patch('/friends/{friend}', 'FriendsController@accept');
Route::delete('/friends/{friend}', 'FriendsController@destroy');
Route::resource('/posts', 'PostController', ['except' => ['index', 'create']]);
Route::get('/wall', 'WallsController@index')->name('walls');
