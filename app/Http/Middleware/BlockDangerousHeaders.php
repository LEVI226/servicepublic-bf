<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockDangerousHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->has('X-Original-URL') || $request->headers->has('X-Rewrite-URL')) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
