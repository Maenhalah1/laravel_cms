<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Image;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->authorizeResource(Post::class);
    }
    public function index()
    {
        $data["posts"] = Auth::user()->posts;
        return view("admin.posts.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        if($post->save()){
            if($request->file("images")){
                foreach ($request->file("images") as $file){
                    $image = new Image();
                    $imageName =  time() . rand(0,100000000000) * 40 . "." . $file->getClientOriginalExtension();
                    $imagePath =  trim($post->imgsPath, Config::get("constents.DS"));
                    $image->path = $imageName;
                    if($post->images()->save($image))
                        $file->storeAs($imagePath, $imageName);
                }
            }
            session()->flash("post-message", "The Post is Created Success");
        }
        return redirect()->route("admin.posts.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit",["post"=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        if($post->save()){
            if($request->file("images")){
                foreach ($request->file("images") as $file){
                    $image = new Image();
                    $imageName =  time() . rand(0,100000000000) * 40 . "." . $file->getClientOriginalExtension();
                    $imagePath =  trim($post->imgsPath, Config::get("constents.DS"));
                    $image->path = $imageName;
                    if($post->images()->save($image))
                        $file->storeAs($imagePath, $imageName);
                }
            }
            session()->flash("post-message", "The Post is Updated Success");
        }
        return redirect()->route("admin.posts.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){
       if($post->delete())
           session()->flash("post-message", "The Post Was Destroy");
       return back();
    }


    public function deletePostImage(Post $post, $image_id){
        $image = $post->images()->whereId($image_id)->first();
        if(!$image){
            return redirect()->route("admin.posts.index");
        }
        $path = storage_path("app" . DIRECTORY_SEPARATOR . "public" . $post->imgsPath . $image->path);
        if(file_exists($path)){
            $image->delete();
            File::delete($path);
        }
        return back();
    }


    public function trash(){
       $data["posts"] = Auth::user()->posts()->onlyTrashed()->get();
       return view("admin.posts.trash", $data);
    }

    public function trashDelete($id){
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->authorize("forceDelete", $post);
        $post->forceDelete();
        session()->flash("post-message", "The Post Was Permanently Deleted");
        return back();
    }


    public function trashRestore($id){
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->authorize("restore", $post);
        $post->restore();
        session()->flash("post-message", "The Post Was Restored");
        return back();
    }

}
