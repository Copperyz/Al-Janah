<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (! is_null($permission)) {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }

        if ( is_null($permission) ) {
            $permission = $request->route()->getName();

            $permissions = array($permission);
        }
        

        foreach ($permissions as $permission) {
            for($s = 0; $s < $authGuard->user()->roles->count(); $s++ ){
                if ($authGuard->user()->roles[$s]->hasPermissionTo($permission)) {
                    return $next($request);
                }
            }
            //dd($authGuard->user()->hasAnyRole('admin')->hasPermissionTo());
        }
    //    dd("Not Authorized");
        throw UnauthorizedException::forPermissions($permissions);
    }
}