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

class ConferenceAmendmentController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function add(Request $request, $conferenceID) {
        $role = Participant::where("id", $conferenceID)
            ->where("account", Auth::id())
            ->first()
            ->role;
        $title = $request->input('title');
        $article = $request->input('article');
        $method = $request->input('method');
        Amendment::insert([
            'article' => $article,
            'role' => $role,
            'conf_id' => $conferenceID,
            'title' => $title,
            'accept' => "pending",
            'method' => $method
        ]);
        return view("app.conference.amendment.add")
            ->with("page", "after")
            ->with("title", $title)
            ->with("status", "ok");
    }

    public function addUI($conferenceID) {
        return view("app.conference.amendment.add")
            ->with("page", "before")
            ->with("conf_id", $conferenceID);
    }

    public function accept(Request $request, $conferenceID) {
        //$role = $request->input('role');
        $status = $request->input("status");
        $id = $request->input('id');
        if (Gate::check('is-admin',[$conferenceID])) {
            Amendment::where('id', $id)
                ->updateOrInsert([
                    'id' => $id
                ], [
                    'accept' => $status
                ]);
            return response()->json([
                'id' => $id,
                'status' => "ok",
                'msg'=>"OK! ID:{$id}"
            ]);
        }else{
            return response()->json([
                'status' => "fail",
                'msg'=>'Permission Denied'
            ]);
        }

    }

    public function change(Request $request, $conferenceID) {
        //$role = $request->input('role');
        $article = $request->input("article");
        $id = $request->input('id');
        Amendment::where('id', $id)
            ->updateOrInsert([
                'id' => $id
            ], [
                'article' => $article
            ]);
        return response()->json([
            'id' => $id,
            'status' => "ok",
        ]);
    }

    //目錄
    public function home($conferenceID) {
        $amendments = Amendment::where("conf_id", $conferenceID)->get()->all();
        /*Amendment::where("id",$conferenceID)->insert([
            "conf_id"=>$conferenceID,
            "role"=>"Japan",
            "title"=>"alter OS",
            "article"=>"default",
            "accept"=>"pending"
        ]);*/
        if (!Gate::check('is-admin',[$conferenceID])) {
            foreach($amendments as $i=>$amendment){
                if($amendment->accept!="true")unset($amendments[$i]);
            }
        }
        return view('app.conference.amendment.home')
            ->with("conf_id", $conferenceID)
            ->with("admin",Gate::check('is-admin',[$conferenceID]))
            ->with("amendments", $amendments);
    }
}
