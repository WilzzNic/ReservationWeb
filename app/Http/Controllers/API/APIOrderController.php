<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Table;
use App\Models\Restaurant;

class APIOrderController extends Controller
{
    // public function index(Request $request) {
    //     $date = Carbon::parse($request->input('trip-start'));
    //     echo $date;
    // }

    public function checkAvailability(Request $request, $id) {
        $seat_type_id = $request->seat_type_id;
        $schedule_id = $request->schedule_id;
        $intended_date = $request->intended_date;

        $total_table = Table::find($seat_type_id)->total_table;
        
        $scheduled_count = Order::where('schedule_id', $schedule_id)
                            ->where('reservation_date', $intended_date)
                            ->where('status', Order::ORDER_ACCEPTED)
                            ->count();
        
        if($scheduled_count < $total_table) {
            return response()->json([
                'scheduled_count' => $scheduled_count,
                'total_table' => $total_table,
                'status' => 'Available'
            ], 200);
        }
        else {
            $schedules = Restaurant::find($id)->schedules;
            $collection = collect();

            for($i = 1; $i <= 3; $i++) {
                foreach($schedules as $schedule) {
                    $modified_date = Carbon::parse($intended_date)->addDays($i)->toDateString();
                    $modified_sch_count = Order::where('schedule_id', $schedule->id)
                            ->where('reservation_date', $modified_date)
                            ->where('status', Order::ORDER_ACCEPTED)
                            ->count();

                    if($modified_sch_count < $total_table) {
                        $collection->push(['date' => $modified_date, 'time' => $schedule->time_provided]);
                    }
                }
            }

            return response()->json([
                'recommended_time' => $collection
            ], 200);
        }
        
    }

    public function order(Request $request, $id) {
        $new_order = new Order();
        $new_order->customer_id         = $request->customer_id;
        $new_order->table_id            = $request->table_id;
        $new_order->schedule_id         = $request->schedule_id;
        $new_order->status              = Order::ORDER_PENDING;
        $new_order->reservation_date    = $request->reservation_date;
        $new_order->save();

        return response()->json([
            'message' => 'Order saved with ID ' . $new_order->id
        ], 200);
    }
}
