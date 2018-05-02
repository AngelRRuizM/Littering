<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Test User',
        	'email' => 'user@littering.com',
        	'password' => bcrypt('secret'),
            'active' => true
        ]);

        DB::table('users')->insert([
        	'name' => 'Test User 2',
        	'email' => 'user2@littering.com',
        	'password' => bcrypt('secret'),
            'active' => true
        ]);
    }
}
