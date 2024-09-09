<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        switch ($role) {
            case 'admin':
                if ($user->role !== 'admin') {
                    return response()->json(['message' => 'Forbidden'], 403);
                }
                break;

            case 'authenticated':
                if ($user->role !== 'authenticated') {
                    return response()->json(['message' => 'Forbidden'], 403);
                }
                break;

            case 'guest':
                if ($user->role !== 'guest') {
                    return response()->json(['message' => 'Forbidden'], 403);
                }
                break;

            default:
                return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
