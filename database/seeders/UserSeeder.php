<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $user =User::where('email', '=', 'islamyearul@gmail.com')->first();
        if( is_null($user)){
            $user = new User();
            $user->name = 'Islam Yearul';
            $user->email = 'islamyearul@gmail.com';
            $user->password = Hash::make('123456');
            $user->save();
            $user->assignRole('super-admin');
        }
    }
}
