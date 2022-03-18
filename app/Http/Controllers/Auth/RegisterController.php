<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Beekeeper;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $data['phone'] = replaceEmptyChars($data['phone']);

        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'regex:/^(?:00[1-9]{2}|0|\+[1-9]{2})(\d{9})$/', 'unique:beekeepers'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed'],
            'agb'       => ['required']
        ], [
            'phone.regex' => 'Not a valid Format, please use: +41, 0041, 07x or 044',
            'password.regex' => 'Password must contain at least 1x Uppercase, 1x Lowercase, a number and a special character!'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Beekeeper::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'phone'     => formatPhoneNum($data['phone']),
            'user_id'   => $user->id,
        ]);

        return $user;

    }
}
