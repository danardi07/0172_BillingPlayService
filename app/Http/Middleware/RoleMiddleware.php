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
     * @param  string  $role
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized (no user)',
                'statusCode' => 401
            ], 401);
        }


        if ($user->role !== $role) {
            return response()->json([
                'message' => 'Unauthorized (role)',
                'statusCode' => 403
            ], 403);
        }

        return $next($request);
    }
}
