<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class APIOrderController extends Controller
{
    public function index(Request $request) {
        $date = Carbon::parse($request->input('trip-start'));
        echo $date;
    }
}
