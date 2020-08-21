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

class ConferenceVotingController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function change(Request $request, $conferenceID) {
        $role = $request->input('role');
        $voting = $request->input('voting');
        Voting::where("id", $conferenceID)
            ->where('role', $role)
            ->update([
                'voting' => $voting
            ]);
        return response()->json([
            'role' => $role,
            'voting' => $voting,
        ]);
    }

    //目錄
    public function listVote($conferenceID,$voteID) {
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
        foreach ($roles as $role) {
            if (isset($newRoles[$role->role])) {
                array_push($newRoles[$role->role], $role->account);
            } else {
                $newRoles[$role->role] = [$role->account];
            }
        }
        foreach ($votes as $vote) {
            $votesCnt[$vote->voting]++;
            $newVotes[$vote->role] = $vote->voting;
        }
        return view('app.conference.rollCall.home')
            ->with('conf_id', $conferenceID)
            ->with('roles', $newRoles)
            ->with('votes', $newVotes)
            ->with('votesCount', $votesCnt);
    }
    //TODO: MUST Implement Voting Page
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
