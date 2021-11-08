<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "admin";
        $user->email = "admin@example.com";
        $user->password = bcrypt('password'); 
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
