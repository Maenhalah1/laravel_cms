<x-admin-master>
@section("content")
        <div class="col-lg-5 m-auto">
            <div class="mt-5 mb-5">
                <h1 class="text-center mb-3">Edit User</h1>
                @if($user->avatar)
                    <img src="{{"/storage" . $user->imgPath . DIRECTORY_SEPARATOR . $user->avatar}}" alt="" height="130px">
                @endif
                <form action="{{route("admin.users.update", $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <div class="form-group">
                        <label for="avatar">Profile Image</label>
                        <input type="file" name="avatar" id="avatar" placeholder="" class="form-control-file">
                    </div>
                    @error("avatar")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="" class="form-control {{getErrorCssClass($errors,"username", "is-invalid")}} " value="{{inputTextValue("username", $user)}}">
                    </div>
                    @error("username")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="" class="form-control {{getErrorCssClass($errors,"name", "is-invalid")}}" value="{{inputTextValue("name", $user)}}">
                    </div>
                    @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="" class="form-control {{getErrorCssClass($errors,"email", "is-invalid")}}" value="{{inputTextValue("email", $user)}}">
                    </div>
                    @error("email")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="" class="form-control {{getErrorCssClass($errors,"password", "is-invalid")}}">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confim Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="" class="form-control">
                    </div>
                    @error("password")
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Save</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-lg-10 m-auto">
            <div class="card shadow mb-4">
                @if(\Illuminate\Support\Facades\Session::has("users-message"))
                    <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get("users-message")}}</div>
                @endif
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Control</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Control</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @if(!empty($roles))
                                @foreach($roles as $role)
                                    <tr @if(isset($userRoles[$role->id])) style="background-color: #eee" @endif>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            @if(isset($userRoles[$role->id]))
                                                <form action="{{route("admin.users.role.detach", ['user' => $user, 'role' => $role])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Detach</button>
                                                </form>
                                            @else
                                                <form action="{{route("admin.users.role.attach", ['user' => $user, 'role' => $role])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" class="btn btn-primary">Attach</button>
                                                </form>
                                            @endif
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

</x-admin-master>
