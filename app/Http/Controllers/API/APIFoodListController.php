<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Food;
use App\MOdels\Restaurant;

class APIFoodListController extends Controller
{
    public function index($id)
    {
        $foods = Food::select('id','rest_id','food_name','food_desc', 'price', 'food_pic')->where('rest_id', $id)->get();
        $restaurant_name = Restaurant::find($id)->rest_name;

        return response()->json([
            'rest_name' => $restaurant_name,
            'foods' => $foods
        ], 200);
    }

    public function foodDetails($id)
    {
        $food = Food::where('id', $id)->first();

        return response()->json([
            'food_details' => $food
        ], 200);
    }
}
