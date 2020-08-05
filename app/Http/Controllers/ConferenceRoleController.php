<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConferenceRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addRoleUI()
    {
        return view('app.conference.role.add')
            ->with("page","before");
    }

    public function addRole(Request $request)
    {
        $confTitle = $request->input("title");
        try {
            DB::beginTransaction();
            $id = DB::table("conferences")->insertGetId([
                'title' => $confTitle
            ]);
            $origin = DB::table("users")
                ->where('id', Auth::id())
                ->get()
                ->first()
                ->conferences;
            $origin = json_decode($origin,true);
            array_push($origin,$id);
            DB::table("users")
                ->where('id', Auth::id())
                ->update([
                    'conferences'=>json_encode($origin)
                ]);
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
        }
        return view('app.conference.add')
            ->with("title",$confTitle)
            ->with("page","after")
            ->with("status","ok");
    }
    //目錄
    public function home($conferenceID)
    {
        $roles = Participant::where("id",$conferenceID)->get() ?? [];
        /*if(is_null($roles)){
            $roles = [];
        }*/
        return view('app.conference.role.home')
            ->with('roles',$roles)
            ->with('conf_id',$conferenceID);
    }
}
