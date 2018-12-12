<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;

// API for getting restaurant list

class RestaurantListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $restaurants = Restaurant::get();
        return response()->json([
            'restaurants' => $restaurants
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'              => 'required|unique:users,username',
            'password'              => 'required|confirmed',
            'rest_name'             => 'required|unique:restaurants,rest_name',
            'address'               => 'required',
            'telp_no'               => 'required',
            'description'           => 'required',
            'open_time'             => 'required'
        ],
        [
            'username.required'     => 'Username must not be empty.',
            'username.unique'       => 'Username must be unique.',
            
            'password.required'     => 'Password must not be empty.',
            'password.confirmed'    => 'Password invalid. Please retype your password.',

            'rest_name.required'    => 'Restaurant Name must not be empty.',
            'rest_name.unique'      => 'Restaurant Name must be unique.',

            'address.required'      => 'Address must not be empty.',
            'telp_no.required'      => 'Telephone No. must not be empty.',
            'description.required'  => 'Description must not be empty.',
            'open_time.required'    => 'Open Time must not be empty.'
        ]
    );

        $new_user = new User();
        $new_user->username             =   $request->username;
        $new_user->password             =   bcrypt($request->password);
        $new_user->role                 =   "Restaurant";
        $new_user->save();
        
        $new_restaurant = new Restaurant();
        $new_restaurant->user_id        =   $new_user->id;
        $new_restaurant->rest_name      =   $request->rest_name;
        $new_restaurant->address        =   $request->address;
        $new_restaurant->telp_no        =   $request->telp_no;
        $new_restaurant->description    =   $request->description;
        $new_restaurant->open_time      =   $request->open_time; 
        $new_restaurant->save();

        return response()->json([
            'message' => 'Data successfully added.'      
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new_restaurant = Restaurant::find($id);
        
        return response()->json([
            'rest_name'     => $new_restaurant->rest_name,
            'address'       => $new_restaurant->address,
            'telp_no'       => $new_restaurant->telp_no,
            'description'   => $new_restaurant->description,
            'open_time'     => $new_restaurant->open_time     
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
