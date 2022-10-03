<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'dealerId' => 'order1_dealerId',
            'poNumber' => 'order1_poNumber',
            'item_manufacturerPartNo' => 'order1_item_manufacturerPartNo',
            'item_qty' => 1,
            'item_shippingMethodId' => 'order1_item_shippingMethodId',
            'status' => 'order1_status',
            'shippingMethod' => 'order1_shippingMethod',
            'trackingNumber' => 'order1_trackingNumber',
            'invoiceId' => 'order1_invoiceId',
            'message' => 'order1_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order2_dealerId',
            'poNumber' => 'order2_poNumber',
            'item_manufacturerPartNo' => 'order2_item_manufacturerPartNo',
            'item_qty' => 2,
            'item_shippingMethodId' => 'order2_item_shippingMethodId',
            'status' => 'order2_status',
            'shippingMethod' => 'order2_shippingMethod',
            'trackingNumber' => 'order2_trackingNumber',
            'invoiceId' => 'order2_invoiceId',
            'message' => 'order2_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order3_dealerId',
            'poNumber' => 'order3_poNumber',
            'item_manufacturerPartNo' => 'order3_item_manufacturerPartNo',
            'item_qty' => 3,
            'item_shippingMethodId' => 'order3_item_shippingMethodId',
            'status' => 'order3_status',
            'shippingMethod' => 'order3_shippingMethod',
            'trackingNumber' => 'order3_trackingNumber',
            'invoiceId' => 'order3_invoiceId',
            'message' => 'order3_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order4_dealerId',
            'poNumber' => 'order4_poNumber',
            'item_manufacturerPartNo' => 'order4_item_manufacturerPartNo',
            'item_qty' => 4,
            'item_shippingMethodId' => 'order4_item_shippingMethodId',
            'status' => 'order4_status',
            'shippingMethod' => 'order4_shippingMethod',
            'trackingNumber' => 'order4_trackingNumber',
            'invoiceId' => 'order4_invoiceId',
            'message' => 'order4_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order5_dealerId',
            'poNumber' => 'order5_poNumber',
            'item_manufacturerPartNo' => 'order5_item_manufacturerPartNo',
            'item_qty' => 5,
            'item_shippingMethodId' => 'order5_item_shippingMethodId',
            'status' => 'order5_status',
            'shippingMethod' => 'order5_shippingMethod',
            'trackingNumber' => 'order5_trackingNumber',
            'invoiceId' => 'order5_invoiceId',
            'message' => 'order5_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order6_dealerId',
            'poNumber' => 'order6_poNumber',
            'item_manufacturerPartNo' => 'order6_item_manufacturerPartNo',
            'item_qty' => 6,
            'item_shippingMethodId' => 'order6_item_shippingMethodId',
            'status' => 'order6_status',
            'shippingMethod' => 'order6_shippingMethod',
            'trackingNumber' => 'order6_trackingNumber',
            'invoiceId' => 'order6_invoiceId',
            'message' => 'order6_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order7_dealerId',
            'poNumber' => 'order7_poNumber',
            'item_manufacturerPartNo' => 'order7_item_manufacturerPartNo',
            'item_qty' => 7,
            'item_shippingMethodId' => 'order7_item_shippingMethodId',
            'status' => 'order7_status',
            'shippingMethod' => 'order7_shippingMethod',
            'trackingNumber' => 'order7_trackingNumber',
            'invoiceId' => 'order7_invoiceId',
            'message' => 'order7_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order8_dealerId',
            'poNumber' => 'order8_poNumber',
            'item_manufacturerPartNo' => 'order8_item_manufacturerPartNo',
            'item_qty' => 8,
            'item_shippingMethodId' => 'order8_item_shippingMethodId',
            'status' => 'order8_status',
            'shippingMethod' => 'order8_shippingMethod',
            'trackingNumber' => 'order8_trackingNumber',
            'invoiceId' => 'order8_invoiceId',
            'message' => 'order8_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order9_dealerId',
            'poNumber' => 'order9_poNumber',
            'item_manufacturerPartNo' => 'order9_item_manufacturerPartNo',
            'item_qty' => 9,
            'item_shippingMethodId' => 'order9_item_shippingMethodId',
            'status' => 'order9_status',
            'shippingMethod' => 'order9_shippingMethod',
            'trackingNumber' => 'order9_trackingNumber',
            'invoiceId' => 'order9_invoiceId',
            'message' => 'order9_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('orders')->insert([
            'dealerId' => 'order10_dealerId',
            'poNumber' => 'order10_poNumber',
            'item_manufacturerPartNo' => 'order10_item_manufacturerPartNo',
            'item_qty' => 10,
            'item_shippingMethodId' => 'order10_item_shippingMethodId',
            'status' => 'order10_status',
            'shippingMethod' => 'order10_shippingMethod',
            'trackingNumber' => 'order10_trackingNumber',
            'invoiceId' => 'order10_invoiceId',
            'message' => 'order10_message',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
