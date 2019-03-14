<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class logermiddlewares
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
        log::info("Log entry from logermiddlewares");
        return $next($request);
    }



}
