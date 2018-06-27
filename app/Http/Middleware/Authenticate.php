<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($guard == 'api') {
                return response()->json(['success' => false, 'message' => 'Invalid API token.']);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if ($guard == 'admin') {
                    return redirect()->guest('admin/login');
                }
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
