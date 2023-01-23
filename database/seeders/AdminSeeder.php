<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'full_name' => 'Admin',
                'email'  => 'admin@gmail.com',
                'phone'  => '+123456789',
                'password' => Hash::make('admin123'),
                'dpassword'  => 'admin123',
            ]);
        }
    }
}
