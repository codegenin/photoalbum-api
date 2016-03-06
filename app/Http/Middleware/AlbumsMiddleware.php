<?php

namespace App\Http\Middleware;

use Closure;

class AlbumsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->albums->user_id != auth()->user()->id && !$request->albums->is_public) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($request->albums->user_id != auth()->user()->id) {
            if (stristr($request->route()->getName(), 'albums.update')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            if (stristr($request->route()->getName(), 'albums.destroy')) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }
        return $next($request);
    }
}
