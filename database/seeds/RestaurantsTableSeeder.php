<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert(
            [
                'user_id'       => '2',
                'rest_name'     => 'Tea Garden',
                'address'       => 'Jl. Multatuli No.87',
                'telp_no'       => '+0092804821',
                'description'   => 'Tea garden is a restaurant restaurant located at Multatuli Complex wihich serves best quality dish.',
                'open_time'     => '09:00-10.00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]
        );
    }
}
