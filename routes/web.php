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

Route::get('/', "WelcomeController@welcome");

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/news/create', 'NewsController@createNewsArticle');
Route::post('/news/create', 'NewsController@addNewsArticle');
Route::get('/news/edit/{id}', 'NewsController@editNewsArticle');
Route::post('/news/edit/{id}', 'NewsController@processEdit');
Route::get('/news/delete/{id}', 'NewsController@requestDelete');
Route::post('/news/delete/{id}', 'NewsController@confirmDelete');
Route::get('/news/{id}', 'NewsController@showNewsArticle');
Route::get('/news', 'NewsController@overviewArticles');
