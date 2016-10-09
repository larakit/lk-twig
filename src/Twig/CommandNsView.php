<?php
namespace Larakit\Twig;

class CommandNsView extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:ns:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Показать пространства имен View';

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

    public function handle() {
        //################################################################################
        // ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ
        //################################################################################
        $hints = app('view')->getFinder()->getHints();
        ksort($hints);
        $rows = [];
        foreach($hints as $k => $_hints) {
            foreach($_hints as $h) {
                $rows[] = [
                    $k,
                    larasafepath(realpath($h)),
                ];
            }

        }

        $this->table([
            'Ns',
            'Path',
        ], $rows);
        //        dd(Twig::$extensions,Twig::$filters,Twig::$functions,Twig::$globals,Twig::$tests);
    }

}
