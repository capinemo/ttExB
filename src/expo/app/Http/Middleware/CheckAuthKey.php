<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthKey
{
    private $API_KEY = '123';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->API_KEY !== $request->header('authorization')) {
            return response('[]', 404)
                ->header('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
