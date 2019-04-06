<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/restaurants';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username() {
        return 'username';
    }

    protected function guard() {
        return Auth::guard('web');
    }
    
    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required|exists:users',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if (Auth::guard('web')->user()->role == 'Admin') {
                return redirect()->intended('/admin/restaurants');
            }
            else if (Auth::guard('web')->user()->role == 'Restaurant') {
                return redirect()->intended('restaurant/reservations');
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
        // if unsuccessful, then redirect back to the login with the form data
        // return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
