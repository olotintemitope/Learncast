<?php

namespace LearnCast\Http\Controllers\Auth;

use LearnCast\Http\Controllers\Controller;
use LearnCast\Http\Requests\UserRequest;
use LearnCast\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Socialite;
use Validator;

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
     * @param array $data
     *
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
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username'       => strtolower($data['username']),
            'email'          => strtolower($data['email']),
            'password'       => bcrypt($data['password']),
            'provider'       => 'traditional',
            'picture_url'    => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
            'role_id'        => 1,
            'remember_token' => str_random(10),
            'profile_bio'    => 'NULL',
        ]);
    }

    public function postRegister(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');

        $user = User::where('username', '=', strtolower($username))
        ->orWhere('email', '=', strtolower($email))
        ->first();

        if (!is_null($user)) {
            return ['statuscode' => 400, 'message'  => 'User already exist'];
        }

        $user = $this->create($request->all());

        if (!is_null($user)) {
            Auth::attempt($request->only(['username', 'password']));

            return ['statuscode' => 201, 'message'  => 'User created successful'];
        }
    }

    /**
     * This method logs in user.
     *
     * @param UserRequest $request
     *
     * @return redirect
     */
    public function loginUser(UserRequest $request)
    {
        $status = Auth::attempt($request->only(['username', 'password']));

        if (!$status) {
            return redirect('/login')->with(
                'status',
                'Oops! Login attempt failed!'
            );
        }

        return redirect()->intended('/');
    }

    /**
     * This method logs out user.
     *
     * @return redirect
     */
    public function logUserOut()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return redirect($this->redirectTo);
    }

    /**
     * This find user or register the user.
     *
     * @param $user
     * @param $provider
     *
     * @return object $user
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->getId())
        ->where('provider', $provider)
        ->first();

        if (!is_null($authUser)) {
            return $authUser;
        }

        $this->checkDuplicateEmail($user, $provider);

        return $this->createSocialUserLogin($user, $provider);
    }

    /**
     * This method checks for duplicate email address.
     *
     * @param $authUser
     *
     * @return $users
     */
    public function checkDuplicateEmail($user, $provider)
    {
        if ($provider == 'facebook' || $provider == 'github') {
            $findEmail = User::where('email', $user->getEmail())
            ->first();

            if (!is_null($findEmail)) {
                abort(409);
            }
        }
    }

    /**
     * This method creates a user who logs in via social integration.
     *
     * @param $user
     *
     * @return object $user
     */
    public function createSocialUserLogin($user, $provider)
    {
        return User::create([
            'username'       => $user->getNickname() ?: $user->getName(),
            'email'          => $user->getEmail() ?: 'learncast.noemail.app',
            'picture_url'    => $user->getAvatar(),
            'provider_id'    => $user->getId(),
            'role_id'        => 1,
            'remember_token' => str_random(10),
            'provider'       => $provider,
        ]);
    }
}
