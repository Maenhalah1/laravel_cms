<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id){

        $_data["post"] = Post::findOrFail($id);

        return view("post.show", $_data);
    }
}
