<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppGenerator extends Command
{
  /**
   * The console command name.
   * @var string
   */
    protected $name = 'generate:app';

  /**
   * The console command description.
   * @var string
   */
    protected $description = 'Command description.';

  /**
   * Create a new command instance.
   * @return void
   */
    public function __construct()
    {
        parent::__construct();
    }

  /**
   * Execute the console command.
   * @return mixed
   */
    public function fire()
    {
      //
    }

  /**
   * Get the console command arguments.
   * @return array
   */
    protected function getArguments()
    {
        return array(
            array('example1', InputArgument::REQUIRED, 'An example argument.'),
            array('example2', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

  /**
   * Get the console command options.
   * @return array
   */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }
  
    public function handle()
    {
        
    }
}
