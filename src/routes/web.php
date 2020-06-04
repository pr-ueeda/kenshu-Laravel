<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/home', 'HomeController@show')->name('home_show');

Route::resource('/', 'ArticleMetaDataController');

Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article_edit');
Route::post('/article/edit', 'ArticleController@update')->name('article_update');

Route::get('article/delete/{id}', 'ArticleController@destroy')->name('article_delete');

Route::get('/article/{id}', 'ArticleController@show')->name('article.show');

Route::resource('/posts', 'PostsController', ['only' => ['index', 'store']])->names(['store'=> 'posts']);
