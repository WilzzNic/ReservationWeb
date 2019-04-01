<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'customer_id'       => '1',
                'rest_id'           => '1',
                // 'table_id'          => '2',
                'schedule_id'       => '2',
                'status'            => 'Pending',
                'reservation_date'  => '2019-01-31',
                'table_demand'      => 4,
                'date_ordered'      => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'customer_id'       => '1',
                'rest_id'           => '2',
                // 'table_id'          => '3',
                'schedule_id'       => '3',
                'status'            => 'Pending',
                'reservation_date'  => '2019-02-01',
                'table_demand'      => 2,
                'date_ordered'      => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'customer_id'       => '1',
                'rest_id'           => '1',
                // 'table_id'          => '2',
                'schedule_id'       => '2',
                'status'            => 'Pending',
                'reservation_date'  => '2019-02-03',
                'table_demand'      => 4,
                'date_ordered'      => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]
        ]);
    }
}
