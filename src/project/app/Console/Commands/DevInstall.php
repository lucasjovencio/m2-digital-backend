<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configuração do projeto';

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
        shell_exec('composer run-script post-root-package-install'); 
        shell_exec('php artisan key:generate'); 
        shell_exec('php artisan storage:link'); 
        shell_exec('ln -s /var/www/html/storage/app/public /var/www/html/public'); 
        shell_exec('php artisan config:cache'); 
        shell_exec('php artisan migrate'); 
        shell_exec('php artisan l5-swagger:generate'); 
        return 0;
    }
}
