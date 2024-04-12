<?php

namespace App\Http\Middleware;

use Closure;

class BlockHistory
{
    public function handle($request, Closure $next)
{
    $response = $next($request);

    $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    $response->headers->set('Pragma', 'no-cache');
    $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

    $response->setContent($response->getContent() . '<script>
        history.pushState(null, null, location.href);
        window.addEventListener("popstate", function(event) {
            history.pushState(null, null, location.href);
        });
    </script>');

    return $response;
}
}
