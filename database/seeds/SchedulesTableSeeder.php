<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            [
                'rest_id'           => '1',
                'time_provided'     => Carbon::create(0,0,0,7,50,0)->toTimeString(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
            [
                'rest_id'           => '1',
                'time_provided'     => '08:00:00',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]
        ]);
    }
}
