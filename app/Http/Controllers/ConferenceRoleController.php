<?php

namespace App\Http\Controllers;

use App\Speech;
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
    public function addRoleUI($conferenceID)
    {
        $maxID = count(User::all());
        return view('app.conference.role.add')
            ->with("page","before")
            ->with("maxID",$maxID)
            ->with("conf_id",$conferenceID);
    }

    public function addRole(Request $request,$conferenceID)
    {
        $roleName = $request->input("role");
        $userId    = $request->input("id");
        DB::table("participants")->insert([
            'id'=>$conferenceID,
            'role'=>$roleName,
            'account'=>$userId
        ]);
        DB::table("roll_calls")->updateOrInsert([
            'id'=>$conferenceID,
            'role'=>$roleName
        ],[
            'id'=>$conferenceID,
            'role'=>$roleName,
            'status'=>"A"
        ]);
        Speech::updateOrInsert([
                'id'=>$conferenceID,
                'role'=>$roleName
            ],[
                'id'=>$conferenceID,
                'role'=>$roleName,
                'article' => "default"
            ]);

        return view('app.conference.role.add')
            ->with("role",$roleName)
            ->with("id",$userId)
            ->with("page","after")
            ->with("status","ok");
    }
    //目錄
    public function home($conferenceID)
    {
        $roles = Participant::where("id",$conferenceID)->get() ?? [];
        $newRoles = [];
        foreach($roles as $role){
            if(isset($newRoles[$role->role])){
                array_push($newRoles[$role->role],$role->account);
            }else{
                $newRoles[$role->role] = [$role->account];
            }
        }
        return view('app.conference.role.home')
            ->with('roles',$newRoles)
            ->with('conf_id',$conferenceID);
    }
}
