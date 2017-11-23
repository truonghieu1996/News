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
Auth::routes();
//Home page
Route::get('/', function () {
    return view('home');
});

Route::get('/home', 'HomeController@index')->name('home');

//Adminstrator
//Categories
Route::get('/categories', 'CategoriesController@index');
Route::post('/categories/add', 'CategoriesController@postAdd');
Route::post('/categories/update', 'CategoriesController@postUpdate');
Route::get('/categories/delete', 'CategoriesController@getDelete');

//Accounts
Route::get('/changepassword', 'ChangePasswordController@getChangepassword');
Route::post('/changepassword', 'ChangePasswordController@postChangepassword');

//Users
Route::get('/users', 'UsersController@getUsers');
Route::get('/users/delete', 'UsersController@getDelete');
Route::post('/users/update', 'UsersController@postUpdate');
