<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Schedule;
use Yajra\Datatables\Datatables;

use DB;
use Auth;
use Carbon\Carbon;

use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.restaurant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        DB::transaction(function() use ($request) {
            $start_time = Carbon::createFromFormat('G:i', $request->start_time);
            $end_time = Carbon::createFromFormat('G:i', $request->end_time);

            $new_user = new User();
            $new_user->username             =   $request->username;
            $new_user->password             =   bcrypt($request->password);
            $new_user->role                 =   "Restaurant";
            $new_user->save();
            
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id        =   $new_user->id;
            $new_restaurant->rest_name      =   $request->rest_name;
            $new_restaurant->address        =   $request->address;
            $new_restaurant->telp_no        =   "+62". $request->telp_no;
            $new_restaurant->description    =   $request->description;
            $new_restaurant->open_time      =   $start_time->format('H:i') . "-" . $end_time->format('H:i'); 
            
            if($request->hasFile('profile_pic')) {
                if($request->profile_pic->isValid()) {
                    $path = $request->profile_pic->store('public/' . $new_user->id);
                    $new_restaurant->profile_pic = $new_user->id . '/'. $request->profile_pic->hashName();
                }
            }
            else {
                $new_restaurant->profile_pic = null;
            }

            if($request->hasFile('cover_pic')) {
                if($request->cover_pic->isValid()) {
                    $path = $request->cover_pic->store('public/' . $new_user->id);
                    $new_restaurant->cover_pic = $new_user->id . '/'. $request->cover_pic->hashName();
                }
            }
            else {
                $restaurant->cover_pic = null;
            }

            $new_restaurant->save();
        });

        return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // asset('storage/' . auth()->user()->id . '/' . $request->profile_pic->hashName());

        $restaurant = Restaurant::find($id)->load(['user']);
        return view('admin.restaurant.edit', ['restaurant' => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        DB::transaction(function() use ($request, $id) {
            $start_time = Carbon::createFromFormat('G:i', $request->start_time);
            $end_time = Carbon::createFromFormat('G:i', $request->end_time);

            $restaurant = Restaurant::find($id);
            
            $restaurant->user->username             =   $request->username;
            $restaurant->user->password             =   bcrypt($request->password);
            // $restaurant->user->save();
            
            $restaurant->rest_name      =   $request->rest_name;
            $restaurant->address        =   $request->address;
            $restaurant->telp_no        =   "+62". $request->telp_no;
            $restaurant->description    =   $request->description;
            $restaurant->open_time      =   $start_time->format('H:i') . "-" . $end_time->format('H:i'); 
            
            if($request->hasFile('profile_pic')) {
                if($request->profile_pic->isValid()) {
                    $path = $request->profile_pic->store('public/' . $restaurant->user->id);
                    $restaurant->profile_pic = $restaurant->user->id . '/'. $request->profile_pic->hashName();
                }
            }
            else {
                $restaurant->profile_pic = null;
            }

            if($request->hasFile('cover_pic')) {
                if($request->cover_pic->isValid()) {
                    $path = $request->cover_pic->store('public/' . $restaurant->user->id);
                    $restaurant->cover_pic = $restaurant->user->id . '/'. $request->cover_pic->hashName();
                }
            }
            else {
                $restaurant->cover_pic = null;
            }

            $restaurant->push();
        });

        return redirect()->route('restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $restaurant = Restaurant::find($id);
            $table = Table::where('rest_id', $id)->delete();
            $schedule = Schedule::where('rest_id', $id)->delete();
            $restaurant->delete();
        });

        return redirect()->route('restaurants.index');
    }

    public function dataRestaurants() {
        $restaurants = Restaurant::get()->load(['user']);
        return Datatables::of($restaurants)
            ->addColumn('action', function ($restaurants) {
                return 
                        '<div class="col-md-2 col-xs-12" style="margin-right: 10px">
                            <a class="btn btn-xs btn-primary" href="'.route("restaurants.edit", ['id' => $restaurants->id]).'">'
                            .'<i class="glyphicon glyphicon-edit"></i> Edit</a>'
                        .'</div>'

                        .'<div class="col-md-2 col-xs-12">
                            <form method="POST" action='.route("restaurants.destroy", ['id' => $restaurants->id]).'>    
                                <input type="hidden" name="_token" value='.csrf_token().'>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-xs btn-danger">'
                                .'<i class="glyphicon glyphicon-trash"></i> Delete</button></div>'
                            .'</form>'
                        .'</div>';
        })->make(true);
    } 
}
