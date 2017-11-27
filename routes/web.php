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
Route::get('/', 'HomeController@getNews');

Route::get('/home', 'HomeController@getNews');
Route::get('/news/most', 'HomeController@getMostNews');
Route::get('/news/most/amount/view', 'HomeController@getMostView');

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

//Profile
Route::get('/profile', 'ProfileController@getProfile');
Route::post('/profile/update', 'ProfileController@postUpdate');

//News
Route::get('/news', 'NewsController@getNews');
Route::get('/news/mynews', 'NewsController@getMyNews');
Route::post('/news/add', 'NewsController@postAdd');
Route::get('/news/delete', 'NewsController@getDelete');
Route::post('/news/update', 'NewsController@postUpdate');
Route::get('/news/{id}/approved/{status}', 'NewsController@getApproved');
Route::get('/news/detail/{id}', 'NewsController@getDetail');

