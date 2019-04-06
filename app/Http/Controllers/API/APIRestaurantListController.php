<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Table;
use App\Models\Schedule;
use DB;

// use Illuminate\Support\Facades\Storage;

// use Auth;

class APIRestaurantListController extends Controller
{
    public function index(Request $request)
    {
        if($request->q == "") {
            $restaurants = Restaurant::select('id','rest_name','address','telp_no', 'description', 'open_time', 'profile_pic')
                                    ->paginate(5);
        }
        else {
            $restaurants = Restaurant::select('id','rest_name','address','telp_no', 'description', 'open_time', 'profile_pic')
                            ->where('rest_name', 'LIKE', '%'.$request->q.'%')->paginate(5);
        }

        return response()->json([
            'restaurants' => $restaurants
        ], 200);
    }

    public function restaurantProfile($id){
        $new_restaurant = Restaurant::find($id);

        // Uncomment below code for normal quota function
        // $tables = $new_restaurant->tables;

        $tables = DB::table('tables')->select('table_type')->where('rest_id', $id)->distinct()->get();
        
        $schedules = $new_restaurant->schedules;
        $number_of_foods = count($new_restaurant->foods);

        return response()->json([
            'id'            => $new_restaurant->id,
            'rest_name'     => $new_restaurant->rest_name,
            'address'       => $new_restaurant->address,
            'telp_no'       => $new_restaurant->telp_no,
            'description'   => $new_restaurant->description,
            'open_time'     => $new_restaurant->open_time,
            'profile_pic'   => $new_restaurant->profile_pic,
            'cover_pic'     => $new_restaurant->cover_pic,
            'number_of_foods' => $number_of_foods,
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
                $new_restaurant->profile_pic = auth()->user()->id . '/'. $request->profile_pic->hashName();
                $new_restaurant->save();

                $url = asset('storage/' . auth()->user()->id . '/' . $request->profile_pic->hashName());

                return response()->json([
                    'user' => auth()->user()->id,
                    'url' => $url
                ], 200);
            }
        }

        // web URL: http://localhost:8000/storage/1/EGzlev1znilSWVV6slA2oRZCxt85VouxByYE2vFO.png
    }


}
