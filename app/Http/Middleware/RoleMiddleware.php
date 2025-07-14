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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = auth()->user();

        if (!$user) {
            \Log::info('Tidak ada user');
            return response()->json([
                'message' => 'Unauthorized (no user)',
                'statusCode' => 401,
            ], 401);
        }


        $allowedRoles = array_map('trim', explode(',', $roles));

        \Log::info('Role user:', ['role' => $user->role]);

        if (!in_array($user->role, $allowedRoles)) {
            return response()->json([
                'message' => 'Unauthorized (role)',
                'statusCode' => 403,
            ], 403);
        }

        return $next($request);
    }
}
