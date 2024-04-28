<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request by validating the API key.
     *
     * @param Closure(Request):Response $next The next middleware or handler in the pipeline.
     * @return mixed The response returned by the next middleware or handler.
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->validate(['api_key' => 'required|string|exists:users,api_key']);

        if (!$apiKey) {
            return response()->json(['error' => 'API key invalid or is missing'], 401);
        }

        return $next($request);
    }
}
