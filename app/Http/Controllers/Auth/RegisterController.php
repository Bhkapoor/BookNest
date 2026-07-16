<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

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
    protected $redirectTo = '/home';

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
     * @return \Illuminate\Contracts\Validation\Validator
     */
  protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],

        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

        'phone' => ['required', 'digits:10'],

        'course' => ['required', 'string', 'max:100'],

        'semester' => ['required', 'integer', 'between:1,8'],

        'registration_id' => [
            'required',
            'string',
            'exists:valid_students,registration_id',
            'unique:users,registration_id'
        ],

        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
   protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'course' => $data['course'],
        'semester' => $data['semester'],
        'registration_id' => $data['registration_id'],
        'password' => Hash::make($data['password']),
    ]);

    Mail::to($user->email)->send(
        new WelcomeMail($user)
    );

    return $user;
}
}
