<?php

namespace App\Console\Commands;

use App\updateIn;
use Illuminate\Console\Command;

class syncInData extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'sync:in';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'check online updates';

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
    public function handle()
    {

        //$result=Curl::to("http://samsung.dev/sync_data")->get();
        $update = new updateIn();
        $result = $update->syncData();
        if ($result) {
            $this->info("updates checked: New update installed");
        } else {
            $this->info("updates checked: No updates");
        }

    }
}
