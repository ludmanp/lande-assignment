<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configures env';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $environment = file_get_contents($this->laravel->basePath('.env'));

        $environment = str_replace('DB_HOST=127.0.0.1', "DB_HOST=mysql", $environment);
        $environment = str_replace('DB_USERNAME=root', "DB_USERNAME=sail", $environment);
        $environment = preg_replace("/DB_PASSWORD=(.*)/", "DB_PASSWORD=password", $environment);

        file_put_contents($this->laravel->basePath('.env'), $environment);
    }
}
