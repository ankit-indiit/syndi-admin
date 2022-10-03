<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First Model
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2007',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2008',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2009',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2010',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2011',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2012',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2013',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2014',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2015',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2016',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2017',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler',
            'year' => '2018',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Second Model
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2007',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2008',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2009',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2010',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2011',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2012',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2013',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2014',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2015',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2016',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2017',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('vehicles')->insert([
            'name' => 'Wrangler 2dr',
            'year' => '2018',
            'model' => 'Jeep',
            'make' => 'US',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
    }
}
