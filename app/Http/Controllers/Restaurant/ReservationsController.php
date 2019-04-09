<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

use App\Models\Order;

class ReservationsController extends Controller
{
    public function index() {
        return view('restaurant.reservation.reservations');
    }

    public function assign() {
        return view('restaurant.reservation.assign');
    }

    public function reject() {

    }

    public function details() {

    }

    public function dataOrders() {
        $id = Auth::guard('web')->user()->restaurant->id;
        $orders = Order::where('rest_id', $id)
                        ->where('status', Order::ORDER_PENDING)
                        ->orWhere('status', Order::ORDER_ACCEPTED)
                        ->orderByRaw("FIELD(status , 'Pending', 'Accepted') ASC")
                        ->get()
                        ->load(['customer', 'schedule', 'foods', 'table']);

        return Datatables::of($orders)
            ->addColumn('action', function ($orders) {

                $unassigned_order_buttons = '<span style="display:inline-block;">
                                            <a class="btn btn-xs btn-primary" href="'.route("reservations.assign", ['id' => $orders->id]).'">'
                                                .'<i class="glyphicon glyphicon-edit"></i> Assign
                                            </a></span>&nbsp;'
                                            .'<span style="display:inline-block;">
                                            <form method="POST" action='.route("reservations.reject", ['id' => $orders->id]).'>    
                                                <input type="hidden" name="_token" value='.csrf_token().'>
                                                <button class="btn btn-xs btn-danger">'
                                                .'<i class="fa fa-close"></i> Reject</button></div>'
                                            .'</form></span>';

                $assigned_order_buttons = '<span style="display:inline-block;">
                                                <a class="btn btn-xs btn-primary" href="'.route("reservations.assign", ['id' => $orders->id]).'">'
                                                .'<i class="glyphicon glyphicon-edit"></i> Resssign</a>'
                                            .'</div></span>';

                if($orders->status == Order::ORDER_PENDING) {
                    return $unassigned_order_buttons;
                }
                else {
                    return $assigned_order_buttons;
                }

        })->make(true);
    }
}
