<?php
namespace Larakit\Twig;

use Larakit\Twig;

class CommandTwig extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:show:twig';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Показать зарегистрированные функции, тесты и фильтры TWIG';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function colored($string, $style) {
        return "<$style>$string</$style>";
    }

    public function handle() {
        //################################################################################
        // ФИЛЬТРЫ
        //################################################################################
        $header  = [
            'ТИП',
            'Название',
            'Параметры',
        ];
        $rows    = [];
        $filters = Twig::$filters;
        ksort($filters);

        foreach($filters as $name => $callback) {
            $r      = new \ReflectionFunction($callback);
            $params = [];
            if(count($r->getParameters())) {
                foreach($r->getParameters() as $p) {
                    $params[] = $p->getName();
                }
            } else {
                $params[] = '';
            }
            $rows[] = [
                $this->colored('FILTER','comment'),
                $this->colored($name,'comment'),
                $this->colored(implode(',', $params),'comment')
            ];
        }
        //################################################################################
        // ФУНКЦИИ
        //################################################################################
        $functions = Twig::$functions;
        ksort($functions);
        foreach($functions as $name => $callback) {
            $r      = new \ReflectionFunction($callback);
            $params = [];
            if(count($r->getParameters())) {
                foreach($r->getParameters() as $p) {
                    $params[] = $p->getName();
                }
            } else {
                $params[] = '';
            }
            $rows[] = [
                $this->colored('FUNCTION','info'),
                $this->colored($name,'info'),
                $this->colored(implode(',', $params),'info')
            ];
        }
        //################################################################################
        // ТЕСТЫ
        //################################################################################
        $tests = Twig::$tests;
        ksort($tests);
        foreach($tests as $name => $callback) {
            $r      = new \ReflectionFunction($callback);
            $params = [];
            if(count($r->getParameters())) {
                foreach($r->getParameters() as $p) {
                    $params[] = $p->getName();
                }
            } else {
                $params[] = '';
            }
            $rows[] = [
                $this->colored('TEST','comment'),
                $this->colored($name,'comment'),
                $this->colored(implode(',', $params),'comment')
            ];
        }
        //################################################################################
        // ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ
        //################################################################################
        $globals = Twig::$globals;
        ksort($globals);
        foreach($globals as $k => $v) {
            $rows[] = [
                $this->colored('GLOBAL','info'),
                $this->colored($k,'info'),
                $this->colored($v,'info')
            ];

        }

        $this->table($header, $rows);
        //        dd(Twig::$extensions,Twig::$filters,Twig::$functions,Twig::$globals,Twig::$tests);
    }

}
