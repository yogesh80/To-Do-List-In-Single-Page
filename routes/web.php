<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('tasks', 'TaskController');
    Route::get('change/{id}','TaskController@changeStatus')->name('changeStatus');


});