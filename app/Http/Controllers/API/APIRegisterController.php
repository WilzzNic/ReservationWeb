<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;

use App\Http\Requests\RegisterRequest;

class APIRegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        $new_user = new User();
        $new_user->username = $request->username;
        $new_user->password = bcrypt($request->password);
        $new_user->role     = "Customer";
        $new_user->save();

        $new_customer = new Customer();
        $new_customer->user_id      = $new_user->id;
        $new_customer->cust_name    = $request->cust_name;
        $new_customer->gender       = $request->gender;
        $new_customer->address      = $request->address;
        $new_customer->telp_no      = $request->telp_no;
        $new_customer->save();

        return response()->json([
            'message' => 'Account successfully created for '. $new_customer->cust_name   . '.'  
        ], 200);
    }
}
