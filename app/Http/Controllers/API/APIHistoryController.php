<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use DB;

class APIHistoryController extends Controller
{
    public function index()
    {
        // Uncomment this if using Normal Table Function
        // $orders = Order::where("customer_id", auth()->user()->customera->id)->with(["schedule", "table.restaurant", "foods"])->get();

        // Uncomment this if using Table Numbering Function
        $orders = Order::where("customer_id", auth()->user()->customera->id)
                    ->with(["schedule" => function($query) {
                        $query->withTrashed();
                    },
                    "table" => function($query) {
                        $query->withTrashed();
                    },
                    "restaurant" => function($query) {
                        $query->withTrashed();
                    },
                    "foods" => function($query) {
                        $query->withTrashed();
                    }])
                    ->orderBy('date_ordered', 'desc')
                    ->get();

        return response()->json([
            "histories" => $orders
        ], 200);
    }
}
