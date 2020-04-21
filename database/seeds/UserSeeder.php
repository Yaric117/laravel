<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

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


        $role = [
            [
                'name' => 'admin',
                'email' => 'admin@laravel.loc',
                'email_verified_at' => now(),
                'password' => '$2y$10$W1naXoDqQWoG/ZMGsgrZx.0VP7XWH60u13KbmRpFvuP5BlX0lW0.u', // password
                'remember_token' => Str::random(10),
                'role_id' => 1,

            ],
            [
                'name' => 'content',
                'email' => 'content@laravel.loc',
                'email_verified_at' => now(),
                'password' => '$2y$10$W1naXoDqQWoG/ZMGsgrZx.0VP7XWH60u13KbmRpFvuP5BlX0lW0.u', // password
                'remember_token' => Str::random(10),
                'role_id' => 2,
            ],
            [
                'name' => 'user',
                'email' => 'user@laravel.loc',
                'email_verified_at' => now(),
                'password' => '$2y$10$W1naXoDqQWoG/ZMGsgrZx.0VP7XWH60u13KbmRpFvuP5BlX0lW0.u', // password
                'remember_token' => Str::random(10),
                'role_id' => 3,
            ],
        ];


        return $role;
    }
}
