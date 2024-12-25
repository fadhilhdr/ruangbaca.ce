<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan memiliki role yang sesuai
        if (!$request->user() || $request->user()->role->name !== $role) {
            // Jika role tidak sesuai, beri response 403 Forbidden
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}