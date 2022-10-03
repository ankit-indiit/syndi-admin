<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name'      => 'go-jeep.myshopify.com',
            'email'     => 'ericseezzadev@outlook.com',
            'password'  => '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',
        ]);
    }
}
