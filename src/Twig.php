<?php
namespace Larakit;

use Illuminate\Support\Arr;

class Twig {
    static public $filters    = [];
    static public $functions  = [];
    static public $tests      = [];
    static public $extensions = [];
    static public $globals    = [];

    /**
     * Поставить в очередь регистрацию теста Twig
     *
     * @param $name
     * @param $callback
     */
    static function register_filter($name, $callback) {
        self::$filters[$name] = $callback;
    }

    /**
     * Поставить в очередь регистрацию теста Twig
     *
     * @param $name
     * @param $callback
     */
    static function register_function($name, $callback) {
        self::$functions[$name] = $callback;
    }

    /**
     * Поставить в очередь регистрацию теста Twig
     *
     * @param $name
     * @param $callback
     */
    static function register_test($name, $callback) {
        self::$tests[$name] = $callback;
    }

    /**
     * Поставить в очередь регистрацию расширения Twig
     *
     * @param $name
     */
    static function register_extension($name) {
        self::$extensions[$name] = $name;
    }

    static function get_global($name) {
        return Arr::get(self::$globals, $name);
    }

    static function register_global($name, $value) {
        self::$globals[$name] = $value;
    }

    /**
     * Добавление в Twig всех зарегистрированных функций, фильтров и тестов
     */
    static function apply() {
        foreach (self::$filters as $name => $callback) {
            \Twig::addFilter(new \Twig_SimpleFilter($name, $callback));
        }
        foreach (self::$functions as $name => $callback) {
            \Twig::addFunction(new \Twig_SimpleFunction($name, $callback));
        }
        foreach (self::$tests as $name => $callback) {
            \Twig::addTest(new \Twig_SimpleTest($name, $callback));
        }
        foreach (self::$extensions as $name) {
            \Twig::addExtension(new $name);
        }
        foreach (self::$globals as $k => $v) {
            \Twig::addGlobal($k, $v);
        }
    }
}