<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use Yajra\Datatables\Datatables;

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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function dataRestaurants() {
        $restaurants = Restaurant::get()->load(['user']);
        return Datatables::of($restaurants)
            ->addColumn('action', function ($restaurants) {
                return 
                        '<div class="col-md-2 col-xs-12" style="margin-right: 5px">
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
