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
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'username' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => str_random(10),
                'api_token' => 'testtoken'
            ],
            [
                'username' => 'test',
                'email' => 'test@gmail.com',
                'password' => str_random(10),
                'api_token' => 'testtoken1'
            ]
        ]);
    }
}
