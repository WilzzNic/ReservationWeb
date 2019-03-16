<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\User;

class APIProfileController extends Controller
{
    public function custProfile() {
        $user = User::find(auth()->user()->id);
        return response()->json([
            "id" => $user->customer->id,
            "username" => $user->username,
            "cust_name" => $user->customer->cust_name,
            "gender" => $user->customer->gender,
            "address" => $user->customer->address,
            "telp_no" => $user->customer->telp_no
        ], 200);
    }
    
    public function editCustProfile(EditCustRequest $request) {
        $user = User::find(auth()->user()->id);
        $customer = $user->customer;
        $user->username = $request->username;
        $customer->cust_name = $request->cust_name;
        $customer->gender = $request->gender;
        $customer->address = $request->address;
        $customer->telp_no = $request->telp_no;
        $user->save();
        $customer->save();
        return response()->json(["message" => "Profile updated."], 200);
    }

    public function custHistory() {
        $user = User::find(auth()->user()->id);
        $history = $user->customer->history;
    }
}
