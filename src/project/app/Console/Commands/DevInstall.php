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
        $this->info('Composer concluído.');
        shell_exec('php artisan key:generate'); 
        $this->info('Chave da aplicação gerada.');
        shell_exec('php artisan optimize'); 
        $this->info('Cache da aplicação renovado.');
        shell_exec('php artisan migrate'); 
        $this->info('Migração concluida.');
        shell_exec('php artisan l5-swagger:generate'); 
        $this->info('Swagger gerado.');
        return 0;
    }
}
