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
                'table_id'          => '2',
                'schedule_id'       => '2',
                'status'            => 'Pending',
                'reservation_date'  => '2019-01-31',
                'date_ordered'      => Carbon::now()
            ],
            [
                'customer_id'       => '1',
                'table_id'          => '3',
                'schedule_id'       => '3',
                'status'            => 'Pending',
                'reservation_date'  => '2019-02-01',
                'date_ordered'      => Carbon::now()
            ]
        ]);
    }
}
