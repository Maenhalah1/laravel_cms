<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\Rules\currentPassword;
use App\Rules\Password;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function index(){
        $data["users"] = User::all();
        return view("admin.users.index", $data);
    }

    public function destroy(User $user){
        if($user->delete()){
            $file = storage_path("public") . $user->imgPath;
            File::delete($file);
            session()->flash("users-message", "the user was deleted");
        }
        return redirect()->route("admin.users.index");
    }

    public function edit(User $user){
       $userRoles = [];
       $data["user"] = $user;
       foreach ($user->roles as $role){
           $userRoles[$role->id] = true;
       }
       $data["userRoles"] = $userRoles;
//       $data["roles"]  =  Role::leftJoin("user_role",function ($join){
//            $join->on("roles.id", "=", "user_role.role_id");
//        })->where("user_role.user_id", "!=", 1)->orWhereNull("user_role.user_id")->get(["roles.*"]);

        $data["roles"] = Role::all();
        return view("admin.users.edit", $data);
    }

    public function update(User $user, Request $request){
        $rules = [
            "username" => ["required", "min:3", "max:255","regex:/^(?:[A-Za-z]).*$/","alpha_dash"],
            "email" => ["required", "email"],
            "name" => ["required", "alpha_spaces"],
            "avatar" => ["image", "mimes:png,jpg,jpeg,gif,svg", "max:5000"]
        ];
        if($request->password || $request->password_confirmation){
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
            session()->flash("users-message", "the user was updated");

        }
        return redirect()->route("admin.users.index");
    }

    public function roleAttach(User $user, Role $role){
        if(!$user->roles->contains($role)){
            $user->roles()->attach($role->id);
            session()->flash("users-message", "the role has been attached to user");
        }
        return back();
    }

    public function roleDetach(User $user, Role $role){
        if($user->roles->contains($role)){
            $user->roles()->detach($role->id);
            session()->flash("users-message", "the role has been detached to user");
        }
        return back();
    }
}
