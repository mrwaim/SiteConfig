<?php

namespace Klsandbox\SiteConfig\Http\Middleware;

use Klsandbox\SiteConfig\Services\SiteConfig;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class ConfigMiddleware
{
    /**
     * @var SiteConfig $config
     */
    protected $config;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     *
     * @return void
     */
    public function __construct(SiteConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $configName, $targetValue = true)
    {
        if ($targetValue === null) {
            $targetValue = true;
        }

        if ($this->config->{$configName} !== $targetValue) {
            \App::abort(403, 'Config:' . $configName);
        }

        return $next($request);
    }
}
