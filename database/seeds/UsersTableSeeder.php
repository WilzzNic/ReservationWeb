<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            [
                'username' => 'Andi Jones',
                'password' => bcrypt('secret'),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => 'budiman05',
                'password' => bcrypt('secret'),
                'role' => 'Restaurant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => 'maimon',
                'password' => bcrypt('secret'),
                'role' => 'Customer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'username' => 'KFC_is_the_best',
                'password' => bcrypt('secret'),
                'role' => 'Restaurant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
        
    }
}
