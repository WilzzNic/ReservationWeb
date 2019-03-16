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
        DB::table('restaurants')->insert([
            [
                'user_id'       => '2',
                'rest_name'     => 'Tea Garden',
                'address'       => 'Jl. Multatuli No.87',
                'telp_no'       => '+0092804821',
                'description'   => 'Tea garden is a restaurant restaurant located at Multatuli Complex wihich serves best quality dish.',
                'open_time'     => '09:00-10:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'user_id'       => '4',
                'rest_name'     => 'Kentucky Fried Chicken',
                'address'       => 'Jl. Perintis Kemerdekaan No.1',
                'telp_no'       => '+0872561221',
                'description'   => 'Chicken straight from Kentucky.',
                'open_time'     => '10:00-23:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'user_id'       => '5',
                'rest_name'     => 'Sushi Tei',
                'address'       => 'Jl. Perintis Kemerdekaan No.1',
                'telp_no'       => '+0872561221',
                'description'   => 'Chicken straight from Kentucky.',
                'open_time'     => '10:00-23:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'user_id'       => '6',
                'rest_name'     => 'Crazy Crab',
                'address'       => 'Jl. Perintis Kemerdekaan No.1',
                'telp_no'       => '+0872561221',
                'description'   => 'Chicken straight from Kentucky.',
                'open_time'     => '10:00-23:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'user_id'       => '7',
                'rest_name'     => 'Starbucks Coffee',
                'address'       => 'Jl. Perintis Kemerdekaan No.1',
                'telp_no'       => '+0872561221',
                'description'   => 'Chicken straight from Kentucky.',
                'open_time'     => '10:00-23:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'user_id'       => '8',
                'rest_name'     => 'Maxx Coffee',
                'address'       => 'Jl. Perintis Kemerdekaan No.1',
                'telp_no'       => '+0872561221',
                'description'   => 'Chicken straight from Kentucky.',
                'open_time'     => '10:00-23:00',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]
            
        ]);
    }
}
