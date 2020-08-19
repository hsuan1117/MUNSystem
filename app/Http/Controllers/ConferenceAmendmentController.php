<?php

namespace App\Http\Controllers;

use App\Amendment;
use Session;
use Illuminate\Http\Request;
use App\User;
use App\Conference;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Speech;

class ConferenceAmendmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change(Request $request, $conferenceID) {
        //$role = $request->input('role');
        $article = $request->input("article");
        $id   = $request->input('id');
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
    public function home($conferenceID)
    {
        $amendments = Amendment::where("conf_id",$conferenceID)->get()->all();
        /*Amendment::where("id",$conferenceID)->insert([
            "conf_id"=>$conferenceID,
            "role"=>"Japan",
            "title"=>"alter OS",
            "article"=>"default",
            "accept"=>"pending"
        ]);*/
        return view('app.conference.amendment.home')
            ->with("conf_id",$conferenceID)
            ->with("amendments",$amendments);
    }
}
