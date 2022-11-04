<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'account_id'      => '',
            'full_name'     => 'Air Jordan',
            'email'  => 'admin@gmail.com',
            'company'  => '',
            'phone'  => '+15056369512',
            'timezone'  => '',
            'password' => Hash::make('123123'),
            'dpassword'  => '123123',
        ]);
        User::create([
            'account_id'      => '',
            'full_name'     => 'Noman Ahmed',
            'email'  => 'nomanahmeda789@gmail.com',
            'company'  => '',
            'phone'  => '+15512647183',
            'timezone'  => '',
            'role'  => 2,
            'password' => Hash::make('123456'),
            'dpassword'  => '123456',
        ]);
        User::create([
            'account_id'      => '',
            'full_name'     => 'super admin',
            'email'  => 'joshcooldev@gmail.com',
            'role'  => 1,
            'company'  => '',
            'phone'  => '+15512094584',
            'timezone'  => '',
            'password' => Hash::make('admin123@'),
            'dpassword'  => 'admin123@',
        ]);
        User::create([
            'account_id'      => '',
            'full_name'     => 'Noman ahmed',
            'email'  => 'nomanahmeda7898@gmail.com',
            'company'  => '',
            'phone'  => '+15512720130',
            'timezone'  => '',
            'password' => Hash::make('123456789'),
            'dpassword'  => '123456789',
        ]);
        User::create([
            'account_id'      => '',
            'full_name'     => 'Chris Jordan',
            'email'  => 'chrisjordan@gmail.com',
            'company'  => '',
            'phone'  => '+12017818160',
            'timezone'  => '',
            'password' => Hash::make('12345678'),
            'dpassword'  => '12345678',
        ]);
        User::create([
            'account_id'      => '',
            'full_name'     => 'Jack Haris',
            'email'  => 'jackharis@gmail.com',
            'company'  => '',
            'phone'  => '+12017818846',
            'timezone'  => '',
            'password' => Hash::make('12345678'),
            'dpassword'  => '12345678',
        ]);
    }
}
