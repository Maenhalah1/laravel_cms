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

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => "auth"], function(){
    Route::get("/", "HomeController@index")->name("admin.home");
    Route::get("/home", "HomeController@index");
    Route::resource("posts",PostController::class,[
        "except" => ["show"],
        "names" => ["index" => "admin.posts.index",
                    "create" => "admin.posts.create",
                    "store" => "admin.posts.store",
                    "edit" => "admin.posts.edit",
                    "update" => "admin.posts.update",
                    "destroy" => "admin.posts.destroy"]]);
});

Route::get("/post/{id}", "PostController@show")->name("posts.show");
