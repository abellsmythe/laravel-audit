<?php

namespace Toncho\LaravelAudit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use Toncho\LaravelAudit\AuditingServiceProvider;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-audit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel Audit package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Configuration
        $this->info('Publishing config');
        Artisan::call('vendor:publish', [
            '--provider' => AuditingServiceProvider::class,
        ]);

        // Migration
        $this->info('Publishing migration');
        Artisan::call('laravel-audit:table');

        $this->info('Successfully installed Audit');
    }
}
