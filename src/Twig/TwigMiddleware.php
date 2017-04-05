<?php
namespace Larakit\Twig;

Class TwigMiddleware {
    public function handle($request, \Closure $next) {
        \Larakit\Twig::apply();
        return $next($request);
    }
}