<?php
declare(strict_types=1);

namespace Nagyist\NovaMarkdown\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Laravel\Nova\Nova;
use Nagyist\Cachecardnova4\CacheCardNova4;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param \Closure(Request):mixed $next
     * @return Response|JsonResponse
     */
    public function handle(Request $request, \Closure $next): Response|JsonResponse
    {
        return $next($request);
    }

}
