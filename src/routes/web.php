<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/home', 'HomeController@show')->name('home_show');

// トップページ
Route::resource('/', 'ArticleMetaDataController', ['only' => ['index']]);

// 記事の編集と削除
Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article_edit');
Route::post('/article/edit', 'ArticleController@update')->name('article_update');
Route::get('article/delete/{id}', 'ArticleController@destroy')->name('article_delete');
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');

// 記事投稿
Route::resource('/posts', 'PostsController', ['only' => ['index', 'store']])->names(['store'=> 'posts']);

// Tasksの表示, 追加, 削除
Route::get('/tasks', 'TasksController@show')->name('tasks_show');
Route::post('/task', 'TasksController@store')->name('tasks_store');

//Route::resource('/tasks', 'TasksController', ['only' => ['show', 'store']]);
