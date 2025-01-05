<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'database backup';

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
        $databaseName = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        $backupPath = storage_path('app/backup');
        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupFileName = "{$databaseName}_{$timestamp}.sql";

    //     // if (!file_exists($backupPath)) {
    //     //     mkdir($backupPath, 0777, true);
    //     // }

    //     // $command = "mysqldump --username={$username} --password={$password} {$databaseName} >" . storage_path() . "/app/backup/".$backupFileName;

        // $command = "mysqldump --user=". env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . "--host=". env('DB_HOST') . " " . env('DB_DATABASE') . " | gzip > " . storage_path() . "/app/backup/".$backupFileName;


        $command = "mysqldump --user=". env('DB_PATOARI_USERNAME') ." --password=" . env('DB_PATOARI_PASSWORD') . "--host=". env('DB_PATOARI_HOST') . " " . env('DB_PATOARI_DATABASE') . " | gzip > " . storage_path() . "/app/backup/".$backupFileName;

 



    // //   $output = NULL;
    // //   $returnVar = NULL;
        exec($command);

        $this->info("Database backup created successfully: {$backupFileName}");

     
    }
}
