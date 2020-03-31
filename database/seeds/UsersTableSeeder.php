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
        User::create([
	        'name' => 'leonardo',
	        'email' => 'leonardo@gmail.com',
	        'email_verified_at' => now(),
	        'password' => bcrypt('leonardo'), // password
	        'remember_token' => Str::random(10)
        ]);
    }
}
