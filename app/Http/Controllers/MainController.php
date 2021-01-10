<?php

namespace App\Http\Controllers;

use App\Match;
use App\Request as AppRequest;
use App\User;
use Illuminate\Http\Request;
use PDO;

class MainController extends Controller
{

    public function index(Request $request)
    {
        return view('main',['my_id'=>$request->session()->get('id')[0]]);
    }

    public function setLastSeen(Request $request)
    {
        $user = User::find($request->session()->get('id')[0]);
        date_default_timezone_set("Asia/Bangkok");
        $user->update([
            'last_seen' => date('Y-m-d H:i:s')
        ]);

        $loggedInUser = User::whereRaw('last_seen BETWEEN NOW() - INTERVAL 15 SECOND AND NOW()')->get();
        return response()->json($loggedInUser);
    }

    public function sendRequest(Request $request)
    {
        AppRequest::create([
            'from'=>$request->session()->get('id')[0],
            'to'=>$request->id,
            'status'=>'pending'
        ]);
    }

    public function getPlayRequest(Request $request){
        $requestList = AppRequest::with('from')->where('to',$request->session()->get('id')[0])->where('status','pending')->get();
        return response()->json($requestList);
    }

    public function getOwnPlayRequest(Request $request){
        $requestList = AppRequest::with('to')->where('from',$request->session()->get('id')[0])->where('status','pending')->get();
        return response()->json($requestList);
    }

    public function getMatchList(Request $request){
        $requestList = Match::with('firstPlayer','secondPlayer')->where('user_id_1',$request->session()->get('id')[0])->orWhere('user_id_2',$request->session()->get('id')[0])->orderBy('created_at', 'desc')->limit(3)->get();
        return response()->json($requestList);
    }

    public function refuseRequest(Request $request) {
        $req = AppRequest::find($request->id);
        $req->status='rejected';
        $req->save();
    }

    public function acceptRequest(Request $request){
        $req = AppRequest::find($request->id);
        $req->status='accepted';
        $req->save();

        $randomNumber = rand(0,1);
        $icon1 = ($randomNumber==0) ? 'O' : 'X';
        $icon2 = ($icon1 == 'O') ? 'X' : 'O';
        $turn = rand(1,2);

        Match::create([
            'user_id_1'=>$req->from,
            'user_id_2'=>$req->to,
            'user_1_icon'=>$icon1,
            'user_2_icon'=>$icon2,
            'turn'=>$turn
//            'user_1_icon'=>'O',
//            'user_2_icon'=>'X'
        ]);
    }
}
