<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Closure;

class CheckForCredentials
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

        // check role parent or organization
        // check if child id is given
            // if child id is given check if parent is actually the parent of the child.

        return $next($request);
    }
}
