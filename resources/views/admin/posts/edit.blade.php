<x-admin-master>
    @section("content")
        <h1 class="text-center">Edit Post</h1>
        @foreach($post->images as $image)
                <form action="{{route("admin.posts.image.delete", [$post->id, $image->id])}}" method="post" enctype="multipart/form-data" id="image{{$image->id}}">
                @csrf
                </form>
        @endforeach

        <div class="col-lg-6 m-auto">
            <form action="{{route("admin.posts.update", $post->id)}}" method="post" enctype="multipart/form-data" id="main">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" form="main" name="title" id="title" placeholder="Type Post Title" class="form-control" value="{{inputTextValue("title", $post)}}">
                </div>
                @error("title")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                @if(!$post->images->isEmpty())
                <div class="images-container">
                    @foreach($post->images as $image)
                    <div class="image-box">

                            <button type="submit" class="btn btn-danger" form="image{{$image->id}}">Delete</button>


                        <img  height="90px" src="{{"/storage". $post->imgsPath . $image->path }}" alt="">
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="form-group">
                    <label for="images">Images</label>
                    <input type="file" name="images[]" id="images" multiple class="form-control-file" form="main">
                </div>
                @error("images")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                @foreach($errors->get("images.*") as $file)
                    <div class="alert alert-danger">{{$file[0]}}</div>
                @endforeach

                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea name="body" form="main" id="body" cols="30" rows="10" class="form-control">{{inputTextValue("body", $post)}}</textarea>
                </div>
                @error("body")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control" form="main">Save</button>
                </div>

            </form>
        </div>
    @endsection
</x-admin-master>
