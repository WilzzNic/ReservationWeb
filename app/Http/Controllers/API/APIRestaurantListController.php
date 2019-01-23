<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Table;
use App\Models\Schedule;

use Illuminate\Support\Facades\Storage;

// use Auth;

class APIRestaurantListController extends Controller
{
    public function index()
    {   
        $restaurants = Restaurant::select('id','rest_name','address','telp_no', 'description', 'open_time', 'profile_pic', 'cover_pic')
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
                'open_time'     => $new_restaurant->open_time,
                'profile_pic'   => $new_restaurant->profile_pic,
                'cover_pic'     => $new_restaurant->cover_pic
            ],
            'seat_type' => $tables,
            'time_type' => $schedules
        ], 200);
    }

    // Base logic for edit restaurant profile

    public function uploadImage(Request $request) {
        $new_restaurant = Restaurant::find(1);
        
        if($request->hasFile('profile_pic')) {
            if($request->profile_pic->isValid()) {
                $path = $request->profile_pic->store('public/' . auth()->user()->id);
                $new_restaurant->profile_pic = $request->profile_pic->hashName();
                $new_restaurant->save();

                $url = asset('storage/' . auth()->user()->id . '/' . $request->profile_pic->hashName());

                return response()->json([
                    'user' => auth()->user()->id,
                    'url' => $url
                ], 200);
            }
        }

        // web URL: http://localhost:8000/storage/1/TPS0BXBkwPsL7WQ8SFDV3uP0OLOCvDrLtrTAHN1I.jpeg
    }
}
