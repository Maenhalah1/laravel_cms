<x-admin-master>
@section("content")
    <!-- DataTales Example -->
        @if(\Illuminate\Support\Facades\Session::has("role-message"))
            <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("role-message")}}</div>
        @endif
        <div class="row">
            <div class="col-5">
                <form action="{{route("admin.roles.update",$role->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" placeholder="" class="form-control" value="{{inputTextValue("name", $role)}}">
                    </div>
                    @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
            <div class="card shadow mb-4 col-7">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Control</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Control</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($permissions->isNotEmpty())
                                @foreach($permissions as $permission)
                                    <tr @if(isset($rolePermissions[$permission->id])) style=" background-color: #ddd" @endif>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>

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
