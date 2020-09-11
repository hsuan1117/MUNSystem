<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;
use Auth;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //用戶清單
    public function users()
    {
        //print_r(User::all());
        $users = User::all();
        return view('manage.users')
            ->with("users",$users)
            ->with("admin",Gate::check('is-admin',[]));
    }

    public function login(Request $request){
        $userId = $request->input('id');
        if(Gate::check('is-admin',[])){
            Auth::loginUsingId($userId);
        }
        return redirect()->route('app.conference.home');
    }

    //目錄
    public function home()
    {
        return view('manage.home')
            ->with("isAdmin",Gate::check('is-admin',[null]));
    }
}
