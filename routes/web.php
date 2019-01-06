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
/****************   general Routes   ***************/

Route::get("/","PostController@index");
Route::get("/posts/{postid}","PostController@show");
Route::get('/categories', 'CategoryController@index');
Route::get("/categories/{categoryid}/posts","CategoryController@getCategoryPosts");


Route::group(['prefix' => '/admin/dashboard'],function(){

    Route::get('/', 'AdminController@index')->name('dashboard');

    /****************   Authentication Routes   ***************/
    Auth::routes();
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    /****************   Authenticated Admin Routes   ***************/
    Route::group(['middleware' => 'auth'],function() {
        Route::post('categories', 'CategoryController@store');
        Route::put('categories/{categoryid}', 'CategoryController@update');
        Route::delete('/categories/{categoryid}', 'CategoryController@destroy');

        Route::get('posts/create', 'PostController@create');
        Route::post('posts', 'PostController@store');
        Route::get('posts/{postid}/edit', 'PostController@edit');
        Route::put('posts/{postid}', 'PostController@update');
        Route::delete('/posts/{postid}', 'PostController@destroy');
    });
});


