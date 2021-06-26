<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userPermissions = [];

        $user = Auth::user();
        foreach ($user->roles as $role){
            foreach ($role->permissions as $permission){
                $userPermissions[$permission->id] = $permission->slug;
            }
        }

        foreach ($userPermissions as $permission_id => $slug){
            Gate::define($slug, function($permission_id){
               return true;
            });
        }
        return $next($request);
    }
}
