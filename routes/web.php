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
    return view('public/index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/{anypath}','HomeController@index')->where('path','.*');
Route::group(['middleware' => ['auth']], function () {
    /*-----------------------Category-------------------------*/
    Route::post('/save-category','CategoryController@saveCategory');
    Route::get('/view-category','CategoryController@viewCategory');
    Route::get('/edit-category/{id}','CategoryController@editCategory');
    Route::post('/update-category/{id}','CategoryController@updateCategory');
    Route::get('/delete-category/{id}','CategoryController@deleteCategory');


    /*----------------------------------post--------------------*/

    Route::get('/view-post','PostController@viewPost');
    Route::post('/save-post','PostController@savePost');
    Route::get('/edit-post/{id}','PostController@editPost');
    Route::post('/update-post/{id}','PostController@updatePost');
    Route::get('/delete-post/{id}','PostController@deletePost');
});

Route::get('/blog-post-view','BlogController@getBlogPost');
Route::get('/single-post-view/{id}','BlogController@getSiglePost');
Route::get('/all-category','BlogController@allCategory');
Route::get('/categories/{id}','BlogController@caregories');
Route::get('/search','BlogController@searchPost');



