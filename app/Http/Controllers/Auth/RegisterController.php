<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\UserActivate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use DB;


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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:20|unique:users',
            'firstname' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => str_random(30).time(),
        ]);


        /**
         * 
         * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         * before using this set the gmail address and password first 
         * 
         * 
         * 
         * 
         */
        
         //$user->notify(new UserActivate($user));
        // use the up line after set up the gmail
        $user->update(['active' => User::ACTIVE]);
        /****************************************************************** */

        
        $id = $user->id;

        $value = array('user_id' => $id, 'default' => 'Yes');
        
        DB::table('address')->insert($value);
        DB::table('contact')->insert($value);

        return $user;
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user=$this->create($request->all())));

        return redirect()->route('login')->with(['success' => 'Congratulations! your account is registered, you will shortly receive an email to activate your account.']);
    }


    public function activate($token = null)
    {
        $user = User::where('token', $token)->first();

        if (empty($user))
        {
            return redirect()->to('/')->with(['error' => 'Your activation code is either expired or invalid.']);

        }

        $user->update(['token' => null, 'active' => User::ACTIVE]);

        return redirect()->route('login')
            ->with(['success' => 'Congratulations! your account is now activated.']);

    }


}
