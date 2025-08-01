<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $allowedTokens = preg_split('/[,\s]+/', config('api.tokens'), -1, PREG_SPLIT_NO_EMPTY);
        $token = $request->header('x-api-token');

        if (!$token || !$allowedTokens || !in_array($token, $allowedTokens)) {
            abort(403, 'Provide valid API-token');
        }

        return $next($request);
    }
}
