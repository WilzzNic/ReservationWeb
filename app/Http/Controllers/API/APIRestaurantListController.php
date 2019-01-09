<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Table;
use App\Models\Schedule;

class APIRestaurantListController extends Controller
{
    public function index()
    {   
        $restaurants = Restaurant::select('id','rest_name','address','telp_no', 'description', 'open_time')
                                    ->get();
        return response()->json([
            'restaurants' => $restaurants
        ], 200);
    }

    public function restaurantProfile($id){
        $new_restaurant = Restaurant::find($id);
        $tables = $new_restaurant->tables;
        $schedules = $new_restaurant->schedules;

        return response()->json([
            'restaurant' => [
                'id'            => $new_restaurant->id,
                'rest_name'     => $new_restaurant->rest_name,
                'address'       => $new_restaurant->address,
                'telp_no'       => $new_restaurant->telp_no,
                'description'   => $new_restaurant->description,
                'open_time'     => $new_restaurant->open_time
            ],
            'seat_type' => $tables,
            'time_type' => $schedules
        ], 200);
    }
}
