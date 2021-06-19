<x-admin-master>
    @section("content")
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if(\Illuminate\Support\Facades\Session::has("post-message"))
                <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("post-message")}}</div>
            @endif
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Craeted Time</th>
                            <th>Last Updated</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Created Time</th>
                            <th>Last Updated</th>
                            <th>Control</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if(!empty($posts))
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td><a href="{{route("admin.posts.edit", $post->id)}}">{{$post->title}}</a></td>
                                <td>{{\Illuminate\Support\Str::limit($post->body, 70, "....")}}</td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->updated_at->diffForHumans()}}</td>
                                <td>
                                    {{--Delete Form--}}
                                    <form action="{{route("admin.posts.destroy", $post->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section("footer-scripts")
        <!-- Page level plugins -->
            <script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
            <script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset("js/demo/datatables-demo.js")}}"></script>

    @endsection
</x-admin-master>
