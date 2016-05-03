<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignupRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logUserOut', 'postRegister']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => strtolower($data['username']),
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
            'picture_url' => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
            'role_id' => 1, 
            'remember_token' => str_random(10),
        ]);
    }

    public function postRegister(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');

        $user = User::where('username', '=', strtolower($username))
        ->orWhere('email', '=', strtolower($email))
        ->first();

        if (! is_null($user)) {
            return ['statuscode' => 400,'message'  => 'User already exist', ];
        }

        $user = $this->create($request->all());

        if (! is_null($user)) {
            Auth::attempt($request->only(['username', 'password']));

            return ['statuscode' => 200,'message'  => 'User created successful',];
        }
    }

    /**
     * This method logs in user
     * 
     * @param  UserRequest $request
     * 
     * @return redirect
     */
    public function loginUser(UserRequest $request)
    {
         $status = Auth::attempt($request->only(['username', 'password']));

         if (! $status) {
            return redirect('/login')->with(
                'status', 
                'Oops! Login attempt failed!'
            );
         }

        return redirect('/')->with(
                'status', 
                'Sucessfully logged in!'
        );

    }

    /**
     * This method logs out user
     * 
     * @return redirect
     */
    public function logUserOut()
    {
         Auth::logout();

        return redirect('/');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
    }
}
