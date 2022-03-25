<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to the home screen. The controller uses a trait
    | to conveniently provide its functionality.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect Users to based on role
     * @return string
     */
    public function redirectTo():string
    {
        return Auth::user()->is_admin ? '/contract/create':'/profile';
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
