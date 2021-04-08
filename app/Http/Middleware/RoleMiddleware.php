<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {

        if (is_null($request->user()))
        {
            abort(404);
        }

        if ($permission !== null && !$request->user()->hasPermissionTo($permission))
        {
            abort(404);
        }

        return $next($request);
    }
}
