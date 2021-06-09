<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $user=User::create([
                    'name' => 'Ayşe TAŞ',
                    'email' => 'aysetas@gmail.com',
                    'password' =>123456
                ]

            );
            $user->attachRole(1);




       /* $user=new User();
        $user->name='ayse';
        $user->email='aysetas@gmail.com';
        $user->password=bcrypt(123456);
        $user->save();
        $user->attachRole(1);
*/
    }

}
