<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_roles')->insert($this->getCategory());
    }

    private function getCategory()
    {


        $role = [
            [
                'name' => 'admin'

            ],
            [
                'name' => 'content'
            ],
            [
                'name' => 'user'
            ],
        ];


        return $role;
    }
}
