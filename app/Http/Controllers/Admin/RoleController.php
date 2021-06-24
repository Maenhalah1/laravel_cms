<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){

        return view("admin.roles.index",["roles"=>Role::all()]);
    }

    public function destroy(Role $role){

        if($role->delete()){
            session()->flash("role-message", "the role  has been deleted");
        }
        return back();
    }

    public function store(Request $request){
        $request->validate([
            "name" => ["required"]
        ]);
        $role = new Role();
        $role->name = Str::ucfirst($request->name);
        $role->slug = str_replace(" ","-", Str::lower($request->name));
        $role->save();
        return back();
    }

    public function edit(Role $role){
        $data["role"] = $role;
        $rolePermissions = [];
        foreach ($role->permissions as $permission){
            $rolePermissions[$permission->id] = true;
        }
        $data["rolePermissions"] = $rolePermissions;
        $data["permissions"] = Permission::all();
        return view("admin.roles.edit", $data);
    }

    public function update(Role $role, Request $request){
        $request->validate([
            "name" => ["required"]
        ]);
        $role->name = Str::ucfirst($request->name);
        $role->slug = str_replace(" ","-", Str::lower($request->name));
        if($role->isDirty("name")){ // if return true that means the data is updated
            session()->flash("role-message", "the role  has been updated");
            $role->save();
        }
        return back();
    }
}
