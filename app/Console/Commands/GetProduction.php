<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;

use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SES;

use App\Models\User;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Vehicle;


class GetProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getproduct:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $groupopen = Groupopen::first();

        if (is_null($groupopen)) 
        {
            $opentime = 0;
            $closetime = 0;
            $current_time = Carbon::now()->timestamp;
        }
        else {
            $opentime = strtotime($groupopen->opentime);
            $closetime = strtotime($groupopen->closetime);
            $current_time = Carbon::now()->timestamp;
        }
        
        $users = User::where('email', '!=', null)
                        ->where('email', '!=', '')
                        ->where('email_verify', 1)
                        // ->where('role', 3)
                        ->where('open_shop_ntf', 1)
                        ->where('status', 1)
                        ->get();
        
        foreach ($users as $user) {
            $email_content = [
                'content' => 'Group purchase is opened from 老宅门面食坊.'
            ];
    
            if ($user->email_verify == 1) {
                Mail::to($user->email)->send(new SES($email_content));
                
                $status = 0;
        
                try {
                    if(Mail::failures() != 0) {
                        $status = 200;
                    } 
                    else {
                        $status = 500;
                    }
                } catch (QueryException $e) {
                    $status = 500;
                }
            }
    
        }
        // return 0;
    }
}
