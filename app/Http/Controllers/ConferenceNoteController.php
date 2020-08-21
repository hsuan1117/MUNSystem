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
use App\Note;


class ConferenceNoteController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function add(Request $request, $conferenceID) {
        $role = Participant::where("id", $conferenceID)
            ->where("account", Auth::id())
            ->first();
        if(is_null($role)){
            return view("app.conference.note.add")
                ->with("page", "after")
                ->with("msg", "Please add the country first!")
                ->with("conf_id",$conferenceID)
                ->with("status", "fail");
        }else{
            $role = $role->role;
        }
        $title = $request->input('title');
        $article = $request->input('article');
        $recipient = $request->input('recipient');
        Note::insert([
            'article' => $article,
            'role' => $role,
            'conf_id' => $conferenceID,
            'title' => $title,
            'accept' => "pending",
            'recipient' => $recipient
        ]);
        return view("app.conference.note.add")
            ->with("page", "after")
            ->with("msg", "The note '{$title}' is currently being reviewed!")
            ->with("conf_id",$conferenceID)
            ->with("status", "ok");
    }

    public function addUI($conferenceID) {
        return view("app.conference.note.add")
            ->with("page", "before")
            ->with("conf_id", $conferenceID);
    }

    public function accept(Request $request, $conferenceID) {
        //$role = $request->input('role');
        $status = $request->input("status");
        $id = $request->input('id');
        if (Gate::check('is-admin',[$conferenceID])) {
            Note::where('id', $id)
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
        $notes = Note::where("conf_id", $conferenceID)->get()->all();
        if (!Gate::check('is-admin',[$conferenceID])) {
            foreach($notes as $i=>$note){
                if($note->accept!="true")unset($notes[$i]);
            }
        }
        return view('app.conference.note.home')
            ->with("conf_id", $conferenceID)
            ->with("admin",Gate::check('is-admin',[$conferenceID]))
            ->with("notes", $notes);
    }
}
