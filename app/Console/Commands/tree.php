<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class tree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tree';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates folders structure for backup. Also calls storage:link';

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
     * @return mixed
     */
    public function handle()
    {
        system("php artisan storage:link");
        Storage::makeDirectory("/snapshots");
        $this->info("Structure created!");
    }
}