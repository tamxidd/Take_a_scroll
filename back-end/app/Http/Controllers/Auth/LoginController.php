<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // protected $redirectTo = RouteServiceProvider::VDASHBOARD;



    // protected function authenticated(Request $request, $user)
    //     {
    //     if ( $user->type==='vendor' ) {// do your magic here
    //         return redirect()->route('dashboard');
    //     }

    //     return redirect('/home');
    //     }


    public function redirectTo() {
        $user = Auth::user();
        switch(true) {
            case $user->type=='vendor':
                return '/vendor-dashboard';
            case $user->type=='customer':
                return '/';
            default:
                return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
