<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller {
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
    protected $redirectTo = RouteServiceProvider::HOME;
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
         $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (auth()->user()->role == 1) {
                return redirect('director');
            }elseif (auth()->user()->role == 2) {
                return redirect('admin');
            }elseif (auth()->user()->role == 3) {
                return redirect('vertical');
            }elseif (auth()->user()->role == 4) {
                return redirect('spoc');
            }elseif (auth()->user()->role == 5) {
                return redirect('team');
            }elseif (auth()->user()->role == 6) {
                return redirect('vendor');
            }elseif (auth()->user()->role == 7) {
                return redirect('beneficiary');
            }
            elseif (auth()->user()->role == 8) {
                return redirect('finance');
            }
        }else{
            return redirect()->route('login')->with('error','Email-address & Password are wrong.');
        }     
    }
}