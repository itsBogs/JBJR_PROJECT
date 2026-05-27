<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownForMaintenaceWM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config("app.env") == "local" && config("app.maintenance") === true && !$request->is('maintenance') && !$request->is('/') && !$request->is('login*')) {
            return redirect('/maintenance');
        }
        return $next($request);
    }
}
