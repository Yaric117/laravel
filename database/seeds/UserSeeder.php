<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
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
        DB::table('users')->insert($this->getCategory());
    }

    private function getCategory()
    {

        $pass = Hash::make('123');


        $role = [

            [
                'name' => 'admin',
                'email' => 'admin@laravel.loc',
                'email_verified_at' => now(),
                'password' => $pass, // password
                'remember_token' => Str::random(10),
                'role_id' => 1,

            ],
            [
                'name' => 'content',
                'email' => 'content@laravel.loc',
                'email_verified_at' => now(),
                'password' => $pass, // password
                'remember_token' => Str::random(10),
                'role_id' => 2,
            ],
            [
                'name' => 'user',
                'email' => 'user@laravel.loc',
                'email_verified_at' => now(),
                'password' => $pass, // password
                'remember_token' => Str::random(10),
                'role_id' => 3,
            ],
        ];


        return $role;
    }
}
