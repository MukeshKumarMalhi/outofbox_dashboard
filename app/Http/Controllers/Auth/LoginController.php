<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Session;
use Illuminate\Support\Facades\Auth;
use Hash;
use Redirect;
use Validator;
use App\Models\User;
use DateTime;

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
    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
      $Input = $request->all();
      $credentials = $request->only('username', 'password');
      $rules = array(
        'username' => 'required|exists:users,username',
        'password' => 'required|min:6'
      );

      $validator = Validator::make($Input, $rules);

      if ($validator->fails()) {
        return Redirect::back()->withErrors($validator);
      }
      else {
        $username      = $Input['username'];
        $password      = $Input['password'];
        $password      = Hash::make($password);

        $user_detail = User::where('username', $username)->first();
        if(!$user_detail){
          return Redirect::back()->with('error','Invalid Username');
        }
        else
        {
          $hash1 = $user_detail->password; // A hash is generated
          $hash2 = Hash::make($Input['password']);
          $password_check = Hash::check($Input['password'], $hash1) && Hash::check($Input['password'], $hash2);
          if($password_check === false){
            return Redirect::back()->with('error','Invalid Password');
          }
          else {
            $user = User::where('username', $username)->where('status', 'activated')->first();
            if(!$user) {
              return Redirect::back()->with('error','Invalid Account');
            }
            else {
              Auth::attempt($credentials);
              return Redirect::to('admin/dashboard');
            }
          }
          return Redirect::back()->with('error','Invalid Username / Password');
        }
      }
    }
}
