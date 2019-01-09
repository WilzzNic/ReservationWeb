<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Order;

class APIOrderController extends Controller
{
    // public function index(Request $request) {
    //     $date = Carbon::parse($request->input('trip-start'));
    //     echo $date;
    // }

    public function order(Request $request) {
        $new_order = new Order();
        $new_order->customer_id = $request->customer_id;
        $new_order->table_id    = $request->table_id;
        $new_order->schedule_id = $request->schedule_id;

    }
}
