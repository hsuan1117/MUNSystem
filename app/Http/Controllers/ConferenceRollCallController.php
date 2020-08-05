<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use App\RollCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConferenceRollCallController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function change(Request $request, $conferenceID) {
        $role = $request->input('role');
        $status = $request->input('status');
        Participant::where("id", $conferenceID)
            ->where('role', $role)
            ->update([
                'status' => $status
            ]);
        return response()->json([
            'role' => $role,
            'status' => $status,
        ]);
    }

    //目錄
    public function home($conferenceID) {
        $roles = Participant::where("id", $conferenceID)->get() ?? [];
        $rolls = RollCall::where("id", $conferenceID)->get() ?? [];
        $newRoles = [];
        $newRolls = [];
        foreach ($roles as $role) {
            if (isset($newRoles[$role->role])) {
                array_push($newRoles[$role->role], $role->account);
            } else {
                $newRoles[$role->role] = [$role->account];
            }
        }
        foreach ($rolls as $status) {
            $newRolls[$status->role] = $status->status;
        }
        return view('app.conference.rollCall.home')
            ->with('conf_id', $conferenceID)
            ->with('roles', $newRoles)
            ->with('rollCalls', $newRolls);
    }
}
