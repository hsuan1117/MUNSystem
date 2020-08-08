<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use App\RollCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Speech;
use DateTime;
use DateTimeZone;


class ConferenceOpeningSpeechController extends Controller {
    const SPEECH_SECONDS = 60;
    public function __construct() {
        $this->middleware('auth');
    }

    public function startSpeech(Request $request, $conferenceID){
        $role = $request->input('role');
        $now  = new DateTime("now",new DateTimeZone("Asia/Taipei"));
        $current = Conference::where("id",$conferenceID)->first()->speechRole;
        if(
            is_null($current) ||
            (time() - strtotime(Speech::where("id", $conferenceID)
                ->where('role', $current)
                ->first()
                ->start) >= self::SPEECH_SECONDS)
        ){
            Conference::where("id",$conferenceID)->first()->update([
                'speechRole'=>$role
            ]);
            Speech::where("id", $conferenceID)
                ->where('role', $role)
                ->updateOrInsert([
                    'id'=>$conferenceID,
                    'role'=>$role
                ],[
                    'start' => ($now->format(DATE_ISO8601))
                ]);
            return response()->json([
                'start' => ($now->format(DATE_ISO8601)),
                'status' => "ok"
            ]);
        }
        return response()->json([
            'status' => "fail"
        ]);

    }

    public function change(Request $request, $conferenceID) {
        $role = $request->input('role');
        $article = $request->input('article');
        Speech::where("id", $conferenceID)
            ->where('role', $role)
            ->updateOrInsert([
                'id'=>$conferenceID,
                'role'=>$role
            ],[
                'id'=>$conferenceID,
                'role'=>$role,
                'article' => $article
            ]);
        return response()->json([
            'role' => $role,
            'status' => "ok",
        ]);
    }

    //目錄
    public function home($conferenceID) {
        $x =new DateTime("now",new DateTimeZone("Asia/Taipei"));

        $roles = Participant::where("id", $conferenceID)->get() ?? [];
        $speeches = Speech::where("id",$conferenceID)->get() ?? [];
        $newRoles = [];
        $newSpeeches = [];
        foreach($roles as $role){
            if (isset($newRoles[$role->role])) {
                array_push($newRoles[$role->role], $role->account);
            } else {
                $newRoles[$role->role] = [$role->account];
            }
        }
        foreach($speeches as $speech){
            $newSpeeches[$speech->role] = $speech->article;
        }
        return view('app.conference.openingSpeech.home')
            ->with('conf_id', $conferenceID)
            ->with('roles', $newRoles)
            ->with('speeches',$newSpeeches)
            ->with("EZTime",$x->format(DATE_ISO8601));
    }
}
