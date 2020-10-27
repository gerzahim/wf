<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if(!$request->user()->hasAnyRole($role)) {
            abort(404);
        }
        if($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }
        return $next($request);
    }
}
