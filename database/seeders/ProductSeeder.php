<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Sportsman Storage Wall',
            'shopifyId' => '1594679132221',
            'spec_name' => 'XG Cargo',
            'spec_value' => 'storage-wall',
            'descriptionHtml' => '<meta charset="utf-8">Overlanding and camping storage wall. Includes six rows of MOLLE for customization. Upgraded buckles and <span>durable material makes this choice for a</span><strong> first interior upgrade to your Jeep</strong><span> </span><strong>easy</strong><span>. </span>Thin and sleek, the perfect compliment for the Jeep who carries the instruments of adventure.',
            'available_name' => 'active',
            'available_value' => '212',
            'available_thumbnailImageUrl' => 'https://cdn.shopify.com/s/files/1/1982/0005/products/sports-7797.jpg?v=1623721834',
            'price' => 229.98,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Magellan Sportsbar Bags',
            'shopifyId' => '1433809846333',
            'spec_name' => 'XG Cargo',
            'spec_value' => 'magellan-sportsbar-bags',
            'descriptionHtml' => '<meta charset="utf-8">In 1519 Ferdinand Magellan thought the world was much larger than had previously been imagined. Discover how big your world can become with your Jeep and proper integrated camping storage. The "Magellan" sportsbar bag transforms a two dimensional Jeep storage space and into a three dimensional space by building up. Sold as a set.',
            'available_name' => 'active',
            'available_value' => '269',
            'available_thumbnailImageUrl' => 'https://cdn.shopify.com/s/files/1/1982/0005/products/magellan.jpg?v=1646851013',
            'price' => 159.98,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Gama Mounted Sportsbar Storage',
            'shopifyId' => '1421942161469',
            'spec_name' => 'XG Cargo',
            'spec_value' => 'jl-gama-rear-storage-bags',
            'descriptionHtml' => '<meta charset="utf-8"><div>The GAMA bags are the first rear mounting roll bar storage bag sets for your expeditions. This robust rear cargo tool mounts sleekly to the roll bar, turning unused precious space into rock solid storage. Great addition for any overlanding or camping trips. Sold as a set.</div><div></div><div></div><div></div><div><br><strong>***JL VERSION SOLD OUT. SHIPMENTS BEGIN MID-LATE AUGUST**</strong></div>',
            'available_name' => 'active',
            'available_value' => '-11',
            'available_thumbnailImageUrl' => 'https://cdn.shopify.com/s/files/1/1982/0005/products/gamawhite.jpg?v=1646247578',
            'price' => 189.98,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
