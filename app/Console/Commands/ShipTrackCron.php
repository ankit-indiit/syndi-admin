<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Order;

class ShipTrackCron extends Command
{
    protected $signature = 'ship_track:daily';
    protected $description = 'Get Tracking Number from Order';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $limitDate = date('Y-m-d', strtotime('-30 days'));
        $count = 0;
        Order::query()
        ->whereNull('trackingNumber')
        ->whereNotNull('shopifyOrderId')
        ->whereDate('created_at', '>=', $limitDate)
        ->orderBy('id')
        ->chunk(2000, function ($orders) use (&$count) {
            print_r(PHP_EOL.$count.', ');

            foreach ($orders as $order) {
                $shOrderId = $order->shopifyOrderId;

                $ch = curl_init();
        
                $url = sprintf(
                    'https://%s.myshopify.com/admin/api/2022-07/orders/'.$shOrderId.'.json',
                    env('SHOPIFY_STORE'),
                );    
                curl_setopt_array($ch, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                        'X-Shopify-Access-Token: '.env('SHOPIFY_TOKEN')
                    ],
                ]);

                $res = curl_exec($ch);
                $resStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($resStatus == 201 || 
                    $resStatus == 200
                ) {
                    $res = json_decode($res, true);

                    if (isset($res['order'])) {
                        $shOrder = $res['order'];
                        $order = Order::firstWhere('shopifyOrderId', $shOrder['id']);
                        if (!$order) continue;

                        foreach ($shOrder['fulfillments'] as $fulfill) {
                            if (isset($fulfill['tracking_number']) && 
                                $fulfill['tracking_number']
                            ) {
                                $order->update([
                                    'trackingNumber' => $fulfill['tracking_number']
                                ]);
                            }
                        }
                    }
                }
            }

            $count += 30;
        });
    }
}
