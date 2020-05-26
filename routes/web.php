<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', 'CategoriesController');

    Route::resource('tags', 'TagsController');
    
    Route::get('posts/trashed', 'PostsController@trashed')->name('posts.trash');
    Route::put('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
    Route::resource('posts', 'PostsController');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::post('users/profile', 'UsersController@update')->name('users.update-profile');

    Route::get('users', 'UsersController@index')->name('users.index');
    
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});


