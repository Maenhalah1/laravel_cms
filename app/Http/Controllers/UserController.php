<?php

namespace App\Http\Controllers;


use App\Rules\currentPassword;
use App\Rules\Password;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{



    public function profile(){
        $data["user"] = Auth::user();
        return view("users.profile", $data);
    }

    public function updateProfile(Request $request){
        $user = auth()->user();
        $rules = [
            "username" => ["required", "min:3", "max:255","regex:/^(?:[A-Za-z]).*$/","alpha_dash"],
            "email" => ["required", "email"],
            "name" => ["required", "alpha_spaces"],
            "avatar" => ["image", "mimes:png,jpg,jpeg,gif,svg", "max:5000"]
        ];
        if($request->old_password ||  $request->password || $request->password_confirmation){
            $rules["old_password"] = ["required", new currentPassword(Auth::user())];
            $rules["password"] = ["required", new Password(), "confirmed"];
        }
        if($request->username !== $user->username)
            $rules["username"][]= "unique:users";
        if($request->email !== $user->email)
            $rules["email"][]= "unique:users";

        $request->validate($rules);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password)
            $user->password = $request->password;
        $avatar = $request->file("avatar");
        if($avatar){
            $imageName =  time() . rand(0,100000000000) * 40 . "." . $avatar->getClientOriginalExtension();
            $old = $user->avatar;
            $user->avatar = $imageName;
        }
        if($user->save()){
            if($avatar)
                $avatar->storeAs($user->imgPath, $imageName);
            if(isset($old) && $old)
                File::delete(storage_path("public") . $user->imgPath . DIRECTORY_SEPARATOR. $user->avatar);
            session()->flash("profile-update", "the profile was updated");

        }
        return back();
    }
}
