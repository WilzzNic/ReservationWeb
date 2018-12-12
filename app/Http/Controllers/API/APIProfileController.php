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
        return response()->json($user->customer, 200);
    }

    public function custHistory() {
        $user = User::find(auth()->user()->id);
        $history = $user->customer->history;
    }
}
