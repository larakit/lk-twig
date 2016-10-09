<?php
namespace Larakit\Twig;

class CommandTwig extends \Illuminate\Console\Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'larakit:twig';

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
    public function handle() {
        $this->info('Выводим ...');
    }

}
