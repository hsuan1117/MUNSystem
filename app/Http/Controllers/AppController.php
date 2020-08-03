<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //目錄
    public function home()
    {
        return view('app.home');
    }

}
