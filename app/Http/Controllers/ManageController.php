<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;

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

    public function loginAs($userId){
        echo "get";
        if(Gate::check('is-admin',[])){
            Auth::loginUsingId($userId);
        }
        return redirect()->route('about.home');
    }

    //目錄
    public function home()
    {
        return view('manage.home')
            ->with("isAdmin",Gate::check('is-admin',[null]));
    }
}
