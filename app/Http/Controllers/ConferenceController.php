<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addConference(Request $request)
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

    public function showConference($conferenceID)
    {
        $conf = Conference::where("id",$conferenceID)->first();
        Session::put('ConferenceName', $conf->title);
        return view('app.conference.conference')
            ->with("conf_id",$conferenceID)
            ->with("conf_data",$conf);
    }

    public function addConferenceUI()
    {
        return view('app.conference.add')
            ->with("page","before");
    }

    //目錄
    public function home()
    {
        // User [name,level,conferences]
        $currUser = User::where("id",Auth::id())->first();

        // Conference (Only for conference in user)
        //   [title]
        $confData = array();
        foreach($currUser->conferences as $conf){
            $confData[$conf]=Conference::where("id",$conf)->first()->title;
        }

        return view('app.conference.home')
            ->with("userData",$currUser)
            ->with("confData",$confData);
    }
}
