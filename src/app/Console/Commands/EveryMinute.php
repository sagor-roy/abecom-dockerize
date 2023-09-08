<?php

namespace App\Console\Commands;

use App\Models\MobileLoginOtp;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'every:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run This Command In Every Minute';

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
        $mobile_login_otps = MobileLoginOtp::all();
        foreach( $mobile_login_otps as $mobile_login_otp ){
            $from = Carbon::now();
            $to = $mobile_login_otp->created_at;
            $diff_in_minutes = $from->diffInMinutes($to);
            if( $diff_in_minutes > 4 ){
                $mobile_login_otp->delete();
            }
        }
    }
}
