<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Customise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:customcontroller {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Custom Resource Controller';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controllername = $this->argument('name');

        $modelname = $this->option('model');

        $target = "app/Http/Controllers/".$controllername . ".php";

        if(file_exists($target)) :

            if($this->confirm('File already exists. Do you replace this?')) :

                copy(public_path('/template.php'), $target);

                $contents = file_get_contents($target);

                $contents = str_replace("DummyModel", $modelname, $contents);

                $contents = str_replace("Dummyclass", $controllername, $contents);

                file_put_contents($target, $contents);

                $this->info('The custom controller is successfully replaced!');

            endif;



        else :

            copy(public_path('/template.php'), $target);

            $contents = file_get_contents($target);

            $contents = str_replace("DummyModel", $modelname, $contents);

            $contents = str_replace("Dummyclass", $controllername, $contents);            

            file_put_contents($target, $contents);

            $this->info('The custom controller is successfully created!');

        endif;
    }
}
