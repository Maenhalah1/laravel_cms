<x-admin-master>
    @section("content")
        <h1 class="text-center">Create New Post</h1>

        <div class="col-lg-6 m-auto">
            <form action="{{route("admin.posts.store")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" placeholder="Type Post Title" class="form-control">
                </div>
                @error("title")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <label for="images">Images</label>
                    <input type="file" name="images[]" id="images" multiple class="form-control-file">
                </div>
                @error("images")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                @foreach($errors->get("images.*") as $file)
                    <div class="alert alert-danger">{{$file[0]}}</div>
                @endforeach

                <div class="form-group">
                    <label for="body">Body:</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>
                @error("body")
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Create</button>
                </div>

            </form>
        </div>
    @endsection
</x-admin-master>
