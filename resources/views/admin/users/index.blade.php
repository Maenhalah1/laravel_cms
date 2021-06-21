<x-admin-master>
@section("content")
    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @if(\Illuminate\Support\Facades\Session::has("users-message"))
                <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("users-message")}}</div>
            @endif
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Activation</th>
                            <th>Craeted Time</th>
                            <th>Last Updated</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Activation</th>
                            <th>Craeted Time</th>
                            <th>Last Updated</th>
                            <th>Control</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if(!empty($users))
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td><a href="{{route("admin.users.edit", $user->id)}}">{{$user->username}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->active ? "active" : "non-active"}}</td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
                                        {{--Delete Form--}}
                                        <form action="{{route("admin.users.destroy", $user->id)}}" method="post" enctype="multipart/form-data">
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
