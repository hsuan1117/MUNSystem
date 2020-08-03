<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
class ConferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addConference(Request $request)
    {
        $title = $request->input("title");
        $originConferences = User::where("id",Auth::id())->first()->conference;
        array_push($originConferences,(function($title) {
            $conf = new Conference;
            $conf->title = $title;
            $conf->save();
            return $conf->conference_id;
        })($title));

        User::where("id",Auth::id())
            ->update(['conferences' => $originConferences]);
        return view('app.conference.add')
            ->with("title",$title)
            ->with("page","after")
            ->with("status","ok");
    }

    public function showConference($conferenceID)
    {
        $conf = Conference::where("conference_id",$conferenceID);
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

        $currUser = User::where("id",Auth::id())->first();
        //var_dump($currUser);
        return view('app.conference.home')
            ->with("conferences",$currUser->conferences);
    }
}
