<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = \DB::table('users')->count();

        if($numberOfUsers == 0)
        {
            DB::table('users')->insert([
                'role_id' => '1',
                'name' => 'Admin',
                'username' => "admin",
                'email' => 'admin@test.com',
                'mobile' => '1234567891',
                'password' => bcrypt('test1234'),
                'status' => 1,
                'created_at' => carbon::now(),
                'updated_at' => carbon::now()
            ]);

            DB::table('users')->insert([
                'role_id' => '2',
                'name' => 'Customer',
                'username' => "customer",
                'email' => 'customer@test.com',
                'mobile' => '1234567892',
                'password' => bcrypt('test1234'),
                'status' => 1,
                'created_at' => carbon::now(),
                'updated_at' => carbon::now()
            ]);
        }
    }
}
