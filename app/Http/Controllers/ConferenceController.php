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
        $confPWD   = $request->input("password");
        $id = Conference::insertGetId([
            'title' => $confTitle,
            'password'=>$confPWD,
            'votes'=>json_encode([])
        ]);
        $origin = User::where('id', Auth::id())
            ->get()
            ->first()
            ->conferences;
        array_push($origin,$id);
        User::where('id', Auth::id())
            ->update([
                'conferences'=>$origin
            ]);
        return view('app.conference.add')
            ->with("title",$confTitle)
            ->with("page","after")
            ->with("status","ok");
    }

    public function joinConference(Request $request)
    {
        $conferenceID = intval($request->input("conferenceID"));
        $conferencePWD = $request->input("password");
        $origin = User::where("id",Auth::id())->first()->conferences;
        $conf = Conference::where("id",$conferenceID)->first();
        if(!is_null($conf->password)){
            if($conferencePWD === $conf->password){
                array_push($origin,$conferenceID);
                User::where("id",Auth::id())->update([
                    'conferences'=>array_unique($origin)
                ]);
            }else{
                return view('app.conference.join')
                    ->with("msg","Fail to join ")
                    ->with("page","after")
                    ->with("status","fail");
            }
        }else{
            array_push($origin,$conferenceID);
            User::where("id",Auth::id())->update([
                'conferences'=>array_unique($origin)
            ]);
        }
        return view('app.conference.join')
            ->with("msg","Success!!")
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

    public function joinConferenceUI()
    {
        $maxID = count(Conference::all());
        return view('app.conference.join')
            ->with("maxID",$maxID)
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
                //var_dump($_conf);
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
