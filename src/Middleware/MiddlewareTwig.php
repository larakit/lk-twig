<?php
namespace Larakit\Middleware;

Class MiddlewareTwig {
    public function handle($request, \Closure $next) {
        \Larakit\Twig::apply();
        return $next($request);
    }
}