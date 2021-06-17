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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::namespace("Auth")->group(function(){
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
Route::get("/post/{id}", "PostController@show")->name("post.show");

Route::group(["prefix" => "admin", "namespace" => "Admin"], function(){
    Route::get("/", "HomeController@index")->name("admin.home");
    Route::get("/home", "HomeController@index");
});
