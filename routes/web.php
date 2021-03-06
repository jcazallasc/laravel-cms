<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\PostsController;

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

Route::get('/', 'BlogController@index')->name('blog.index');
Route::get('/blog/posts/{post}', 'BlogController@post')->name('blog.post');
Route::get('/blog/categories/{category}', 'BlogController@category')->name('blog.category');
Route::get('/blog/tags/{tag}', 'BlogController@tag')->name('blog.tag');
Route::get('/blog/authors/{user}', 'BlogController@author')->name('blog.author');

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


