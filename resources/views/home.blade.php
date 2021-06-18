<x-main-master>
    @section("navbar")
        @include("layouts.main-navbar")
    @endsection

    @section("slidebar")
        @include("layouts.main-slidebar")
    @endsection

    @section("content")
                <!-- Blog Entries Column -->
                <div class="col-md-8">

                    <h1 class="my-4">Posts
                        <small>| home</small>
                    </h1>
                    <!-- Blog Post -->
                @if(!$posts->isEmpty())
                    @foreach($posts as $post)
                    <div class="card mb-4">
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{$post->title}}</h2>
                            <p class="card-text">{{\Illuminate\Support\Str::limit($post->body,70,"....")}}</p>
                            <a href="{{route("posts.show", [$post->id])}}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{$post->created_at->diffForHumans()}} by
                            <a href="#">{{$post->user->name}}</a>
                        </div>
                    </div>
                    @endforeach
                    <!-- Pagination -->
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item">
                            <a class="page-link" href="#">&larr; Older</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Newer &rarr;</a>
                        </li>
                    </ul>
                @endif

                </div>
    @endsection

</x-main-master>
