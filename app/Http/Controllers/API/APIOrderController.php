<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Order;
use App\Models\FoodOrder;
use App\Models\Table;
use App\Models\Restaurant;

class APIOrderController extends Controller
{
    // public function index(Request $request) {
    //     $date = Carbon::parse($request->input('trip-start'));
    //     echo $date;
    // }

    public function checkAvailability(Request $request, $id) {
        $seat_type = $request->seat_type;
        $schedule_id = $request->schedule_id;
        $intended_date = $request->intended_date;

        $table_provided_count = Table::where('rest_id', $id)
                                    ->where('table_type', $seat_type)
                                    ->count();
        
        $scheduled_count = Order::where('schedule_id', $schedule_id)
                                ->where('reservation_date', $intended_date)
                                ->where('status', Order::ORDER_ACCEPTED)
                                ->whereHas('table.restaurant', function($query) use ($id) {
                                    $query->where('id', $id);
                                })
                                ->whereHas('table', function($query) use ($seat_type) {
                                    $query->where('table_type', $seat_type);
                                })
                                ->count();
        
        if($scheduled_count < $table_provided_count) {
            return response()->json([
                'status' => 'Available',
                'reservation_date' => $intended_date,
                'reservation_schedule_id'=> $schedule_id,
                'reservation_table' => $seat_type,
                'scheduled_count' => $scheduled_count,
                'total_table' => $table_provided_count
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
                                            ->whereHas('table.restaurant', function($query) use ($id) {
                                                $query->where('id', $id);
                                            })
                                            ->whereHas('table', function($query) use ($seat_type) {
                                                $query->where('table_type', $seat_type);
                                            })
                                            ->count();

                    if($modified_sch_count < $table_provided_count) {
                        $collection->push([
                            'date' => $modified_date,
                            'time_id' => $schedule->id,
                            'time' => $schedule->time_provided]);
                    }
                }
            }

            return response()->json([
                'status' => 'Unavailable',
                'reservation_date' => $intended_date,
                'reservation_schedule_id'=> $schedule_id,
                'reservation_table' => $seat_type, 
                'recommended_time' => $collection,
                'time_available_count' => count($collection)
            ], 200);
        }

        // $schedule = Order::with(['table' => function ($query) use ($seat_type_id){
        //                 $query->where('table_type', 4);
        //             }])
        //             ->with(['table.restaurant' => function ($query) use ($id) {
        //                 $query->where('id', $id);
        //             }])
        //             ->get();

        // $schedule = Order::with(["table:id,table_type"])->get();

        return $scheduled_count;
    }

    // public function checkAvailability(Request $request, $id) {
    //     $seat_type_id = $request->seat_type_id;
    //     $schedule_id = $request->schedule_id;
    //     $intended_date = $request->intended_date;

    //     $total_table = Table::find($seat_type_id)->total_table;

    //     $scheduled_count = Order::where('schedule_id', $schedule_id)
    //                         ->where('reservation_date', $intended_date)
    //                         ->where('status', Order::ORDER_ACCEPTED)
    //                         ->count();

    //     if($scheduled_count < $total_table) {
    //         return response()->json([
    //             'status' => 'Available',
    //             'reservation_date' => $intended_date,
    //             'reservation_schedule_id'=> $schedule_id,
    //             'reservation_table_id' => $seat_type_id,
    //             'scheduled_count' => $scheduled_count,
    //             'total_table' => $total_table
    //         ], 200);
    //     }
    //     else {
    //         $schedules = Restaurant::find($id)->schedules;
    //         $collection = collect();

    //         for($i = 1; $i <= 3; $i++) {
    //             foreach($schedules as $schedule) {
    //                 $modified_date = Carbon::parse($intended_date)->addDays($i)->toDateString();
    //                 $modified_sch_count = Order::where('schedule_id', $schedule->id)
    //                         ->where('reservation_date', $modified_date)
    //                         ->where('status', Order::ORDER_ACCEPTED)
    //                         ->count();

    //                 if($modified_sch_count < $total_table) {
    //                     $collection->push([
    //                         'date' => $modified_date,
    //                         'time_id' => $schedule->id,
    //                         'time' => $schedule->time_provided]);
    //                 }
    //             }
    //         }

    //         return response()->json([
    //             'status' => 'Unavailable',
    //             'reservation_date' => $intended_date,
    //             'reservation_schedule_id'=> $schedule_id,
    //             'reservation_table_id' => $seat_type_id, 
    //             'recommended_time' => $collection,
    //             'time_available_count' => count($collection)
    //         ], 200);
    //     }

    // }

    public function order(Request $request) {
        $order_id = DB::transaction(function () use ($request) {
            $new_order = new Order();
            $new_order->customer_id         = auth()->user()->customera->id;
            $new_order->rest_id             = $request->rest_id;

            // Uncomment this for normal quota function
            // $new_order->table_id            = $request->table_id;
            
            // Uncomment this for Table Numbering function
            $new_order->table_demand = $request->table_demand;

            $new_order->schedule_id         = $request->schedule_id;
            $new_order->status              = Order::ORDER_PENDING;
            $new_order->reservation_date    = $request->reservation_date;
            $new_order->save();

            if(isset($request->foods)) {
                foreach($request->foods as $food) {
                    $new_food_order = new FoodOrder();
                    $new_food_order->food_id = $food['id'];
                    $new_food_order->amount  = $food['amount'];
                    $new_order->foodOrder()->save($new_food_order);
                }

                return $new_order->id;
            }

        });

        return response()->json([
            'message' => 'Order saved with ID ' . $order_id
        ], 200);
    }
}
