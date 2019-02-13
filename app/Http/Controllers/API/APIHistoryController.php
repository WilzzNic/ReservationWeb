<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\User;

class APIHistoryController extends Controller
{
    public function index()
    {
        $user_history = User::find(auth()->user()->id)->customera->history;
        return response()->json([
            "histories" => $user_history
        ], 200);
    }
}
