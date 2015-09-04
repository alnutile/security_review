<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ExposeMiddleware
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
        $filters = new \Expose\FilterCollection();
        $filters->load();

        $logger = App::make('log');

        $manager = new \Expose\Manager($filters, $logger);

        $manager->run($request->input());

        Log::info(sprintf("Logging results from Expose %d", $manager->getImpact()));

        return $next($request);
    }
}
