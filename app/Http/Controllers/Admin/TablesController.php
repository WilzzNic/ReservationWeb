<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Table;
use App\Models\Restaurant;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tables.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::get();
        return view('admin.tables.create', ['restaurants' => $restaurants]);
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
            'table_type'    => 'required|numeric|between:1,20',
            'table_no'      => [
                                'required', 
                                Rule::unique('tables')->where(function ($query) use ($request) {
                                    return $query->where('rest_id', $request->restaurant);
                                })
                               ]
        ],
        [
            'table_no.required'    => 'The table number field is required.',
            'table_no.unique'      => 'The table number has already existed.'
        ]);

        $new_table = new Table();
        $new_table->table_type = $request->table_type;
        $new_table->table_no = $request->table_no;

        $restaurant = Restaurant::find($request->restaurant);

        $restaurant->tables()->save($new_table);

        return redirect()->route('tables.index');
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
        $data['table'] = Table::find($id);
        return view('admin.tables.edit', $data);
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
            'table_type'    => 'required|numeric|between:1,20',
            'table_no'      => [
                                'required', 
                                Rule::unique('tables')->where(function ($query) use ($request) {
                                    return $query->where('rest_id', $request->restaurant);
                                })->ignore($id)
                               ]
        ],
        [
            'table_no.required'    => 'The table number field is required.',
            'table_no.unique'      => 'The table number has already existed.'
        ]);

        $table = Table::find($id);
        $table->table_type = $request->table_type;
        $table->table_no = $request->table_no;
        $table->save();

        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        $table->delete();
        return redirect()->route('tables.index');
    }

    public function dataTables() {
        $tables = Table::get()->load(['restaurant']);
        return Datatables::of($tables)
        ->addColumn('action', function ($tables) {
            return 
                '<div class="col-md-1 col-xs-12" style="margin-right:5px;">
                    <a class="btn btn-xs btn-primary" href="'.route("tables.edit", ['id' => $tables->id]).'">'
                    .'<i class="glyphicon glyphicon-edit"></i> Edit</a>'
                .'</div>'

                .'<div class="col-md-1 col-xs-12">
                    <form method="POST" action='.route("tables.destroy", ['id' => $tables->id]).'>    
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
