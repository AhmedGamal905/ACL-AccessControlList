<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $group): Response
    {
        $user = auth()->user();

        abort_if(is_null($user), 403);

        abort_unless($user->hasGroup($group), 403);

        return $next($request);
    }
}
