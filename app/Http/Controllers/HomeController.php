<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $new_pwd = $request->input('new_password');
        $cfm_pwd = $request->input('confirm_password');
        if(strcmp($new_pwd,$cfm_pwd)) {
            return view('auth.passwords.change')
                ->with('status', 'error')
                ->with('message', 'Two passwords are not the same!!');
        }
        if(strlen($cfm_pwd) < 8 ){
            return view('auth.passwords.change')
                ->with('status', 'error')
                ->with('message', 'The password must be at least 8 characters!!');
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user_id = Auth::id();
            $usr = User::find($user_id);
            $usr->password = bcrypt($new_pwd);
            $usr->save();
            Auth::logout();
            return redirect()->route('app.conference.home');
        }else{
            return view('auth.passwords.change')
                ->with('status','error')
                ->with('message','Password is not correct!!');
        }
    }

    public function changePasswordUI(){
        return view('auth.passwords.change')
            ->with('status','pending');
    }

    public function index()
    {
        return view('home');
    }
}
