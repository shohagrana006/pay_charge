<?php

namespace App\Console\Commands;

use App\Models\UserVerifyOtp;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UnverifyUserTokenRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unverify-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unverified user token remove';

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
        $limit = Carbon::now()->subMinutes(5);    
        UserVerifyOtp::where("created_at", "<", $limit)->delete();

    }
}
