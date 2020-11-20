<?php

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

Route::get('/categories/','CategoryController@index')->name('all_categories');
Route::get('/categories/show/{id}','CategoryController@show')->name('show_category');

Route::get('/books/latest','BookController@latest')->name('latest_books');
Route::get('/books/show/{id}','BookController@show')->name('show_books');

//author
Route::get('/authors','AuthorController@index')->name('all_authors');
Route::get('/authors/latest','AuthorController@latest')->name('latest_authors');
Route::get('/authors/show/{id}','AuthorController@show')->name('show_authors');



Route::get('/','BookController@index')->name('all_books');

//if anyone login before cant go again to those routes
Route::middleware('notAuth')->group(function () {
    Route::get('/register', 'AuthController@Register')->name('Register_auth');
    Route::post('/do-register', 'AuthController@doRegister')->name('doRegister_auth');
    Route::get('/login', 'AuthController@Login')->name('Login_auth');
    Route::post('/do-login', 'AuthController@doLogin')->name('doLogin_auth');
});

//if anyone become user can go to those routes
Route::middleware('userAuth')->group(function ()
{


    //logout
    Route::get('/logout','AuthController@Logout')->name('Logout_auth');

    //book
    Route::get('/books/view-pdf/{id}','BookController@viewPDF')->name('viewPDF');
    Route::get('/books/Download/{id}','BookController@Download')->name('Download');


    //if you admin you can update , create , delete books and authors
    Route::middleware('isAdmin')->group(function (){
        //crud for admins only

        //crud categories
        Route::get('/categories/create','CategoryController@create')->name('create_category');
        Route::post('/categories/store/','CategoryController@store')->name('store_category');
        Route::get('/categories/edit/{id}','CategoryController@edit')->name('edit_category');
        Route::post('/categories/update/{id}','CategoryController@update')->name('update_category');
        Route::delete('/categories/delete/{id}','CategoryController@destroy')->name('delete_category');

        //Crud Authors
        Route::get('/authors/create','AuthorController@create')->name('create_author');
        Route::post('/authors/store','AuthorController@store')->name('store_author');
        Route::get('/authors/edit/{id}','AuthorController@edit')->name('edit_author');
        Route::post('/authors/update/{id}','AuthorController@update')->name('update_author');
        Route::delete('/authors/delete/{id}','AuthorController@destroy')->name('delete_author');

        //Crud book
        Route::get('/books/create','BookController@create')->name('create_book');
        Route::post('/books/store','BookController@store')->name('store_book');
        Route::get('/books/edit/{id}','BookController@edit')->name('edit_book');
        Route::post('/books/update/{id}','BookController@update')->name('update_book');
        Route::delete('/books/delete/{id}','BookController@destroy')->name('delete_book');

    });
});


