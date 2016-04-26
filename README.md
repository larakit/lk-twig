[![Total Downloads](https://poser.pugx.org/larakit/lk-twig/d/total.svg)](https://packagist.org/packages/larakit/lk-twig)
[![Latest Stable Version](https://poser.pugx.org/larakit/lk-twig/v/stable.svg)](https://packagist.org/packages/larakit/lk-twig)
[![Latest Unstable Version](https://poser.pugx.org/larakit/lk-twig/v/unstable.svg)](https://packagist.org/packages/larakit/lk-twig)
[![License](https://poser.pugx.org/larakit/lk-twig/license.svg)](https://packagist.org/packages/larakit/lk-twig)
# larakit-twig
Модуль Twig для Larakit

#Возможности
##Step 1
Создавая пакет указываем в composer.json автоподключаемый файл init.php
~~~
{
    "name": ".../...",
    "description": "...",
    "license": "MIT",
    "require": {
        ...
    },

    "autoload": {
        "files": [
			"src/init.php"
        ]
    }
}
~~~

##Step 2
В файле "src/init.php" регистрируем функции, фильтры и расширения

### Добавление фильтров
~~~php
Larakit\Twig::register_filter('int', 'intval');
Larakit\Twig::register_filter('filter_prefix', function($val){
   return 'prefix_'.$value;
});
~~~
Использование в шаблонах Twig
~~~php
{% set var = '123a' %}
Приводим к целому: {{ var|int }}
Добавляем префикс: {{ var|filter_prefix('pref') }}
~~~
Результат:
~~~php
Приводим к целому: 123
Добавляем префикс: pref_123
~~~

### Добавление функций 
~~~php
Larakit\Twig::register_function('lower', 'mb_strtolower');
Larakit\Twig::register_function('function_prefix', function($val, $prefix='prefix'){
   return $prefix.'_'.$value;
});
~~~
Использование в шаблонах Twig
~~~php
{% set var = 'AbCdEfG' %}
В нижнем регистре: {{ lower(var) }}
Добавляем префикс: {{ function_prefix(var, 'PRE') }}
~~~
Результат:
~~~php
В нижнем регистре: abcdefg 
Добавляем префикс: PRE_AbCdEfG
~~~

### Добавление тестов  
~~~php
Larakit\Twig::register_test('num', 'is_numeric');
Larakit\Twig::register_test('age_alcohol', function($val){
   return intval($val)>=18;
});
~~~
Использование в шаблонах Twig
~~~php
{% set var = 38 %}
Значение {{ var }} является числом: {% if var is num %}YES{% else %}NO{% endif%}
Можно ли пить в {{ var }} лет: {% if var is age_alcohol %}YES{% else %}NO{% endif%}
~~~
Результат:
~~~php
Значение 38 является числом: YES
Можно ли пить в 38 лет: YES
~~~
