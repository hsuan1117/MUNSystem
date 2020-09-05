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

class ConferenceSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setStep(Request $request,$conferenceID) {
        $step = $request->input("step");
        $status = false;
        $message = '';
        if (Gate::check('is-admin',[null])) {
            $conf = Conference::where("id", $conferenceID)->first();
            $conf->update([
                'step'=>$step
            ]);
            $status = true;
            $message = "Updated Step!";
        }else{
            $status = false;
            $message = "Permission Denied!";
        }
        return view('app.conference.settings.home')
            ->with('status',$status?'ok':'fail')
            ->with('msg',$message)
            ->with('conferenceID',$conferenceID);
    }

    public function delete(Request $request,$conferenceID) {
        if (Gate::check('is-admin',[null])) {
            $conf = Conference::where("id", $conferenceID)->first();
            $conf->delete();
            return redirect()->route('app.conference.home');
        }else{
            $status = false;
            $message = "Permission Denied!";
            return view('app.conference.settings.home')
                ->with('status',$status?'ok':'fail')
                ->with('msg',$message)
                ->with('conferenceID',$conferenceID);
        }
    }

    //目錄
    public function home($conferenceID)
    {
        return view('app.conference.settings.home')
            ->with('conferenceID',$conferenceID);
    }
}
