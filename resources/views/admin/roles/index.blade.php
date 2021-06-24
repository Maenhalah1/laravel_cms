<x-admin-master>
@section("content")
    <!-- DataTales Example -->
        @if(\Illuminate\Support\Facades\Session::has("role-message"))
            <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("role-message")}}</div>
        @endif
        <div class="row">
            <div class="col-5">
                <form action="{{route("admin.roles.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" placeholder="" class="form-control">
                    </div>
                    @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
            <div class="card shadow mb-4 col-7">
                @if(\Illuminate\Support\Facades\Session::has("post-message"))
                    <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("post-message")}}</div>
                @endif
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(!empty($roles))
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{route("admin.roles.edit", $role->id)}}">{{$role->name}}</a></td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form action="{{route("admin.roles.destroy", $role->id)}}" method="post" enctype="multipart/form-data">
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
