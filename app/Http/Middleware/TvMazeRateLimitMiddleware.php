<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TvMazeRateLimitMiddleware
{
    /**
     * Handle an incoming request by enforcing rate limiting.
     *
     * @param Request $request The incoming request.
     * @param Closure(Request):Response $next The next middleware or handler in the pipeline.
     * @return Response The response returned by the next middleware or handler.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cacheKey = 'api_rate_limit_tv_maze';
        $limit = config('services.tvmaze.rate_limit');
        $windowSeconds = config('services.tvmaze.window_seconds');

        $requestCount = Cache::get($cacheKey . '_count', 0);
        $lastRequestTime = Cache::get($cacheKey . '_time', 0);

        $elapsedTime = time() - $lastRequestTime;

        if ($elapsedTime > $windowSeconds) {
            $requestCount = 0;
        }

        $requestCount++;

        Cache::put($cacheKey . '_count', $requestCount, $windowSeconds);
        Cache::put($cacheKey . '_time', time(), $windowSeconds);

        if ($requestCount > $limit) {
            return response()->json(['error' => 'Rate limit exceeded'], Response::HTTP_TOO_MANY_REQUESTS);
        }
        
        return $next($request);
    }
}
