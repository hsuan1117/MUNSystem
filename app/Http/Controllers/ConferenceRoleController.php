<?php

namespace App\Http\Controllers;

use App\Speech;
use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        if(intval($userId) > count(User::all()) || intval($userId) <= 0 ){
            return view('app.conference.role.add')
                ->with("role",$roleName)
                ->with("id",$userId)
                ->with('message',"Fail to add {$userId} into {$roleName}, user {$userId} doesn't exist!")
                ->with("page","after")
                ->with("status","error");
        }
        if(Gate::check('is-admin',[$conferenceID])){
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
                ->with('message',"Added {$userId} into {$roleName}")
                ->with("page","after")
                ->with("status","ok");
        }else{
            return view('app.conference.role.add')
                ->with("role",$roleName)
                ->with("id",$userId)
                ->with('message',"Permission Denied")
                ->with("page","after")
                ->with("status","error");
        }

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
