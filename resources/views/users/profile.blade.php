<x-main-master>
@section("navbar")
    @include("layouts.main-navbar")
@endsection



@section("content")
<!-- Blog Entries Column -->
    <div class="col-lg-5 m-auto">
        <div class="mt-5 mb-5">
            <h1 class="text-center mb-3">Edit Your Profile</h1>
            @if($user->avatar)
                <img src="{{"/storage" . $user->imgPath . DIRECTORY_SEPARATOR . $user->avatar}}" alt="" height="130px">
            @endif
            <form action="{{route("user.profile.update")}}" method="post" enctype="multipart/form-data">
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
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" placeholder="" class="form-control {{getErrorCssClass($errors,"old_password", "is-invalid")}}">
                </div>
                @error("old_password")
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

    @endsection

</x-main-master>
