<?php

namespace App\Http\Controllers;

use App\VoteInfo;
use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use App\RollCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Voting;
use Illuminate\Support\Facades\Gate;

class ConferenceVotingController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function change(Request $request, $conferenceID, $voteID) {
        $role = $request->input('role');
        $id = $request->input('id');
        $voting = $request->input('voting');
        Voting::where("conf_id", $conferenceID)
            ->updateOrInsert([
                'id'=>$id
            ],[
                'conf_id'=>$conferenceID,
                'vote_id'=>$voteID,
                'role'=>$role,
                'voting' => $voting
            ]);
        return response()->json([
            'role' => $role,
            'voting' => $voting,
        ]);
    }

    public function add(Request $request, $conferenceID) {
        $title = $request->input('title');

        $voteID = VoteInfo::insertGetId([
            #'conf_id' => $conferenceID,
            'title' => $title
        ]);
        $conf = Conference::where("id", $conferenceID)->first()->votes ?? [];
        array_push($conf,$voteID);
        Conference::where("id", $conferenceID)->first()
            ->update([
                'votes'=>$conf
            ]);

        $roles = Participant::where("id", $conferenceID)->get() ?? [];

        $admin = Gate::check('is-admin',[$conferenceID]);
        foreach ($roles as $role) {
            Voting::where("conf_id", $conferenceID)
                ->where('vote_id',$voteID)
                ->where('role',$role->role)
                ->firstOrCreate([
                    "conf_id"=>$conferenceID,
                    'vote_id'=>$voteID,
                    'role'=>$role->role
                ],[
                    "conf_id"=>$conferenceID,
                    'vote_id'=>$voteID,
                    'role'=>$role->role,
                    'voting'=>'Yes'
                ]);
        }



        return view("app.conference.voting.add")
            ->with("page", "after")
            ->with("title", $title)
            ->with("status", "ok");
    }

    public function addUI($conferenceID) {
        return view("app.conference.voting.add")
            ->with("page", "before")
            ->with("conf_id", $conferenceID);
    }

    public function voting($conferenceID,$voteID) {
        $roles = Participant::where("id", $conferenceID)->get() ?? [];
        $votes = Voting::where("conf_id", $conferenceID)
                ->where('vote_id',$voteID)
                ->get() ?? [];
        $newRoles = [];
        $newVotes = [];
        $votesCnt = [
            "Yes"=>0,
            "No"=>0,
            "Abstain"=>0
        ];
        $admin = Gate::check('is-admin',[$conferenceID]);
        foreach ($roles as $role) {
            if (isset($newRoles[$role->role])) {
                array_push($newRoles[$role->role], $role->account);
            } else {
                $newRoles[$role->role] = [$role->account];
            }
        }
        foreach ($votes as $vote){
            $votesCnt[$vote->voting]++;
            $newVotes[$vote->role] = $vote;
        }
        return view('app.conference.voting.voting')
            ->with('conf_id', $conferenceID)
            ->with('vote_id', $voteID)
            ->with('roles', $newRoles)
            ->with('votes', $newVotes)
            ->with('votesCount', $votesCnt)
            ->with('admin',$admin);
    }
    //目錄
    public function home($conferenceID) {
        $roles = Participant::where("id", $conferenceID)->get() ?? [];
        $vote_info = VoteInfo::all() ?? [];
        $votes = Conference::where("id", $conferenceID)->first();

        $newRoles = [];
        $newInfos = [];
        foreach ($roles as $role) {
            if (isset($newRoles[$role->role])) {
                array_push($newRoles[$role->role], $role->account);
            } else {
                $newRoles[$role->role] = [$role->account];
            }
        }
        foreach ($vote_info as $info) {
            $newInfos[$info->id] = $info->title;
        }
        if(!is_null($votes)){
            $votes = $votes->votes;
        }
        $votes = $votes ?? [];
        return view('app.conference.voting.home')
            ->with('conf_id', $conferenceID)
            ->with('roles', $newRoles)
            ->with('votes', $votes)
            ->with('infos', $newInfos);
    }
}
