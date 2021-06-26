<?php


use Illuminate\Support\Facades\Route;
Route::middleware("auth")->group(function(){

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
    Route::post("/posts/{post}/image/{image_id}/delete", "PostController@deletePostImage")->name("admin.posts.image.delete");
    Route::get("/posts/trash", "PostController@trash")->name("admin.posts.trash");
    Route::delete("/posts/trash/{post}/delete", "PostController@trashDelete")->name("admin.posts.trash.delete");
    Route::put("/posts/trash/{post}/restore", "PostController@trashRestore")->name("admin.posts.trash.restore");

    Route::get("/users", "UserController@index")->name("admin.users.index");
    Route::delete("/users/{user}", "UserController@destroy")->name("admin.users.destroy");
    Route::get("/users/{user}/edit", "UserController@edit")->name("admin.users.edit");
    Route::put("/users/{user}", "UserController@update")->name("admin.users.update");

    Route::put("/users/{user}/role/{role}", "UserController@roleAttach")->name("admin.users.role.attach");
    Route::delete("/users/{user}/role/{role}", "UserController@roleDetach")->name("admin.users.role.detach");

    Route::get("/roles","RoleController@index")->name("admin.roles");
    Route::post("/roles","RoleController@store")->name("admin.roles.store");
    Route::get("/roles/{role}","RoleController@edit")->name("admin.roles.edit");
    Route::put("/roles/{role}","RoleController@update")->name("admin.roles.update");
    Route::delete("/roles/{role}","RoleController@destroy")->name("admin.roles.destroy");
    Route::post("/roles/{role}/attach/{permission}","RoleController@permissionAttach")->name("admin.role.attach.permission");
    Route::post("/roles/{role}/detach/{permission}","RoleController@permissionDetach")->name("admin.role.detach.permission");

});

