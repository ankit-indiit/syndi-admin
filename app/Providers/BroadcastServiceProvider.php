<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Specify its auth to be sanctum
        // Broadcast::routes(['middleware' => ['auth:sanctum']]);
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
