<?php

namespace Toncho\LaravelAudit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class TableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-audit:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the audit table';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Composer.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Constructor
     * 
     * @param Filesystem $files
     * @param Composer $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files    = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $source = __DIR__ . '/../database/migrations/create_audit_table.php';

        $destination = $this->laravel['migration.creator']->create(
            'create_audit_table',
            $this->laravel->databasePath() . '/migrations'
        );

        $this->files->copy($source, $destination);

        $this->info('Migration created successfully!');

        $this->composer->dumpAutoloads();
    }
}
