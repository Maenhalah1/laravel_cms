<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::namespace("Auth")->group(function(){
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::group(["middleware" => "auth"],function (){
    Route::get("user/profile","UserController@profile")->name("user.profile");
    Route::put("user/profile/update","UserController@updateProfile")->name("user.profile.update");
});
Route::get("/post/{id}", "PostController@show")->name("posts.show");
