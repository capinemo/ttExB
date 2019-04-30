<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthKey
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
        if ($request->header('authorization') !== '123') {
            return response('[]', 404)
                ->header('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
