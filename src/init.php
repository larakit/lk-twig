<?php
//регистрируем сервис-провайдер
Larakit\Boot::register_provider('TwigBridge\ServiceProvider');
Larakit\Boot::register_alias('Twig', 'TwigBridge\Facade\Twig');
Larakit\Boot::register_command(\Larakit\Twig\CommandTwig::class);

/*################################################################################
  middlewares
################################################################################*/
\Larakit\Boot::register_middleware(\Larakit\Twig\MiddlewareTwig::class);

//######################################################################
// регистрируем фильтры
//######################################################################
Larakit\Twig::register_filter('upper', function ($text) {
    return mb_strtoupper($text);
});

Larakit\Twig::register_filter('lower', function ($text) {
    return mb_strtolower($text);
});

Larakit\Twig::register_filter('int', function ($text) {
    return (int) $text;
});

//######################################################################
// регистрируем функции
//######################################################################
\Larakit\Twig::register_function('env', function ($key, $default = null) {
    return env($key, $default);
});
\Larakit\Twig::register_function('base64_decode', function ($data, $strict = null) {
    return base64_decode($data, $strict);
});
\Larakit\Twig::register_function('base64_encode', function ($data) {
    return base64_encode($data);
});

Larakit\Twig::register_function('phpcode', function ($text) {
    return highlight_string($text, true);
});

Larakit\Twig::register_function('laralang', function ($key, $replace = [], $locale = null, $fallback = true) {
    $val = Lang::get($key, $replace, $locale, $fallback);

    return ($val == $key) ? (App::environment('production') ? '' : $key) : $val;
});

Larakit\Twig::register_function('substr', function ($text, $start, $length) {
    return mb_substr($text, $start, $length);
});

Larakit\Twig::register_function('arr_get', function ($arr, $key, $default = null) {
    return \Illuminate\Support\Arr::get($arr, $key, $default);
});

Larakit\Twig::register_function('widget', function ($class, $name = 'default') {
    if(false === mb_strpos($class, '\\')) {
        $class = '\Larakit\Widget\\Widget' . studly_case($class);
    }

    /** @var \Larakit\Base\Widget $class */
    return $class::factory($name);
});

Larakit\Twig::register_function('config_get', function ($key, $default = null) {
    return \Config::get($key, $default);
});

Larakit\Twig::register_function('current_route_name', function () {
    return \Route::currentRouteName();
});

Larakit\Twig::register_function('route_csrf', function () {
    try {
        $args           = func_get_args();
        $route          = array_shift($args);
        $args           = \Illuminate\Support\Arr::get($args, 0, []);
        $args['_token'] = csrf_token();

        return \URL::route($route, $args);
    }
    catch(Exception $e) {
        return $e->getMessage();
    }
});

Larakit\Twig::register_function('number_format', function ($value, $decimals = 2, $dec_point = ',', $thousans_sep = '.') {
    return number_format($value, $decimals, $dec_point, $thousans_sep);
});

Larakit\Twig::register_function('date_diff_for_humans', function ($value) {
    return \Carbon\Carbon::parse($value)->diffForHumans();
});

//######################################################################
// регистрируем тесты
//######################################################################
Larakit\Twig::register_test('numeric', function ($val) {
    return is_numeric($val);
});
Larakit\Twig::register_test('array', function ($val) {
    return is_array($val);
});
