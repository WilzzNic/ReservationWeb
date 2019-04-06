<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Schedule;
use Yajra\Datatables\Datatables;
use App\Models\Restaurant;
use Illuminate\Validation\Rule;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::get();
        return view('admin.schedule.create', ['restaurants' => $restaurants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'restaurant'    => 'required|exists:restaurants,id',
            'time_provided'      => [
                                'required', 
                                Rule::unique('schedules')->where(function ($query) use ($request) {
                                    return $query->where('rest_id', $request->restaurant);
                                })]
        ],
        [
            'time_provided.required'    => 'The schedule field is required.',
            'time_provided.unique'      => 'The schedule has already existed.'
        ]);

        $new_schedule = new Schedule();
        $new_schedule->time_provided = $request->time_provided;

        $restaurant = Restaurant::find($request->restaurant);

        $restaurant->schedules()->save($new_schedule);
        return redirect()->route('schedules.index');
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
        $data['schedule'] = Schedule::find($id);
        return view('admin.schedule.edit', $data);
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
        $validatedData = $request->validate([
            'time_provided'      => [
                                'required', 
                                Rule::unique('schedules')->where(function ($query) use($request) {
                                    return $query->where('rest_id', $request->restaurant);
                                })->ignore($id)]
        ],
        [
            'time_provided.required'    => 'The schedule field is required.',
            'time_provided.unique'      => 'The schedule has already existed.'
        ]);

        $schedule = Schedule::find($id);
        $schedule->time_provided = $request->time_provided;
        $schedule->save();

        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route('schedules.index');
    }

    public function dataSchedules() {
        $schedules = Schedule::get()->load(['restaurant']);
        return Datatables::of($schedules)
        ->addColumn('action', function ($schedules) {
            return 
                '<div class="col-md-1 col-xs-12">
                    <a class="btn btn-xs btn-primary" href="'.route("schedules.edit", ['id' => $schedules->id]).'">'
                    .'<i class="glyphicon glyphicon-edit"></i> Edit</a>'
                .'</div>'

                .'<div class="col-md-1 col-xs-12">
                    <form method="POST" action='.route("schedules.destroy", ['id' => $schedules->id]).'>    
                        <input type="hidden" name="_token" value='.csrf_token().'>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-xs btn-danger">'
                        .'<i class="glyphicon glyphicon-trash"></i> Delete</button></div>'
                    .'</form>'
                .'</div>';
        })
        ->make(true);
    }
}
