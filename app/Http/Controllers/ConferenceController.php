<?php

namespace App\Http\Controllers;

use App\Amendment;
use Illuminate\Support\Facades\Gate;
use Session;
use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Speech;

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

    public function getStep($conferenceID) {

        $conf = Conference::where("id", $conferenceID)->first();
        return response()->json([
            'step' => $conf->step
        ]);
    }

    public function getSpeaking($conferenceID) {

        $conf = Conference::where("id", $conferenceID)->first();
        //echo $conf;
        $role = Speech::where("id",$conferenceID)->where("role",$conf->speechRole)->first();
        //echo $role;
        return response()->json([
            'role' => $conf->speechRole,
            'start' => $role->start
        ]);
    }

    public function addConferenceUI()
    {
        return view('app.conference.add')
            ->with("page","before");
    }

    //目錄
    public function home()
    {
        if (Gate::check('is-admin',[null])) {
            $currUser = User::where("id",Auth::id())->first();

            $conf = Conference::all();
            $confData = array();
            foreach($conf as $_conf){
                $confData[$_conf->id]=$_conf->title;
            }
        }else{
            // User [name,level,conferences]
            $currUser = User::where("id",Auth::id())->first();

            // Conference (Only for conference in user)
            //   [title]
            $confData = array();
            foreach($currUser->conferences as $conf){
                $confData[$conf]=Conference::where("id",$conf)->first()->title;
            }
        }
        return view('app.conference.home')
            ->with("userData",$currUser)
            ->with("confData",$confData);
    }
}
