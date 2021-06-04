<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>'ayşe',
            'email' => 'aysetas@gmail.com',
            'password' => bcrypt(123456),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)

        ]);
    }
}
