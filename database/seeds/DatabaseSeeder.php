<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->name='test';
        $user->email='test@gmail.com';
        $user->role='admin';
        $user->password=Hash::make('123123123');
        $user->save();
         return $user;
        // $this->call(UserTableSeeder::class);
    }
}
