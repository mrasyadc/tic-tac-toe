<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request,$id){
        return view('game',['match_id'=>$id,'my_id'=>$request->session()->get('id')[0]]);
    }

    public function getGameField(Request $request){
        $match = Match::with('firstPlayer','secondPlayer')->find($request->id);
        return response()->json($match);
    }

    public function setField(Request $request){
        $match = Match::find($request->match_id);
        if($match->status=='finish') return 0;
//        cek match ada
        if(!$match){
            return response(['message'=>'Match not found'],404);
        }
        if($match->user_id_1!=$request->session()->get('id')[0]&&$match->user_id_2!=$request->session()->get('id')[0]){
            return response(['message'=>"you're not allowed to do that"],403);
        }
        $match_arr = $match->toArray();
        if($match->turn==1){
            if($match->user_id_1!=$request->session()->get('id')[0]){
                return response("It's not your turn",403);
            }
            if($match_arr['box_'.$request->field_no]!='#'){
                return response("Box isn't empty",403);
            }
            $match_arr['box_'.$request->field_no] = $match->user_1_icon;
//            Logic Game
            if(($match_arr['box_1']==$match_arr['box_2']&& $match_arr['box_2']==$match_arr['box_3']) ||
                ($match_arr['box_1']==$match_arr['box_4']&& $match_arr['box_1']==$match_arr['box_7']))
            {
//                tambahain kondisi
                if($match_arr['box_1']==$match->user_1_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_1_icon,
                        'turn'=>2,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_1']
                    ]);
                    return 0;
                }
            }

            if (($match_arr['box_2']==$match_arr['box_5']&& $match_arr['box_2']==$match_arr['box_8']) ||
                ($match_arr['box_4']==$match_arr['box_5']&& $match_arr['box_4']==$match_arr['box_6']) ||
                ($match_arr['box_1']==$match_arr['box_5']&& $match_arr['box_1']==$match_arr['box_9']) ||
                ($match_arr['box_3']==$match_arr['box_5']&& $match_arr['box_3']==$match_arr['box_7']))
            {
                if($match_arr['box_5']==$match->user_1_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_1_icon,
                        'turn'=>2,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_1']
                    ]);
                    @dd("jalan 1");
                    return 0;
                }
            }

            if (($match_arr['box_3']==$match_arr['box_6']&& $match_arr['box_3']==$match_arr['box_9']) ||
                ($match_arr['box_7']==$match_arr['box_8']&& $match_arr['box_7']==$match_arr['box_9']))
            {
                if($match_arr['box_9']==$match->user_1_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_1_icon,
                        'turn'=>2,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_1']
                    ]);
                    return 0;
                }
            }

            if ($match_arr['box_1']!='#' &&
                $match_arr['box_2']!='#' &&
                $match_arr['box_3']!='#' &&
                $match_arr['box_4']!='#' &&
                $match_arr['box_5']!='#' &&
                $match_arr['box_6']!='#' &&
                $match_arr['box_7']!='#' &&
                $match_arr['box_8']!='#' &&
                $match_arr['box_9']!='#')
            {
//                return response()->json("if jalan");
                $match->update([
                    'box_'.$request->field_no=>$match->user_1_icon,
                    'turn'=>2,
                    'status'=>'finish',
                    'winner'=>null
                ]);
                return 0;
            }

            if ($match->status!='finish'){
            $match->update([
                'box_'.$request->field_no=>$match->user_1_icon,
                'turn'=>2
            ]);
            }

        }else{
            if($match->user_id_2!=$request->session()->get('id')[0]){
                return response("It's not your turn",403);
            }
            if($match_arr['box_'.$request->field_no]!='#'){
                return response("Box isn't empty",403);
            }
            $match_arr['box_'.$request->field_no] = $match->user_2_icon;

//            New ADD Mulai Disini
            if(($match_arr['box_1']==$match_arr['box_2']&& $match_arr['box_2']==$match_arr['box_3']) ||
                ($match_arr['box_1']==$match_arr['box_4']&& $match_arr['box_1']==$match_arr['box_7']))
            {
//                tambahain kondisi
                if($match_arr['box_1']==$match->user_2_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_2_icon,
                        'turn'=>1,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_2']
                    ]);
                    return 0;
                }
            }

            if (($match_arr['box_2']==$match_arr['box_5']&& $match_arr['box_2']==$match_arr['box_8']) ||
                ($match_arr['box_4']==$match_arr['box_5']&& $match_arr['box_4']==$match_arr['box_6']) ||
                ($match_arr['box_1']==$match_arr['box_5']&& $match_arr['box_1']==$match_arr['box_9']) ||
                ($match_arr['box_3']==$match_arr['box_5']&& $match_arr['box_3']==$match_arr['box_7']))
            {
                if($match_arr['box_5']==$match->user_2_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_2_icon,
                        'turn'=>1,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_2']
                    ]);
                    @dd("jalan 2");
                    return 0;
                }
            }

            if (($match_arr['box_3']==$match_arr['box_6']&& $match_arr['box_3']==$match_arr['box_9']) ||
                ($match_arr['box_7']==$match_arr['box_8']&& $match_arr['box_7']==$match_arr['box_9']))
            {
                if($match_arr['box_9']==$match->user_2_icon){
                    $match->update([
                        'box_'.$request->field_no=>$match->user_2_icon,
                        'turn'=>1,
                        'status'=>'finish',
                        'winner'=>$match_arr['user_id_2']
                    ]);
                    return 0;
                }
            }

            if ($match_arr['box_1']!='#' &&
                $match_arr['box_2']!='#' &&
                $match_arr['box_3']!='#' &&
                $match_arr['box_4']!='#' &&
                $match_arr['box_5']!='#' &&
                $match_arr['box_6']!='#' &&
                $match_arr['box_7']!='#' &&
                $match_arr['box_8']!='#' &&
                $match_arr['box_9']!='#')
            {
                $match->update([
                    'box_'.$request->field_no=>$match->user_2_icon,
                    'turn'=>1,
                    'status'=>'finish',
                    'winner'=>null
                ]);
                return 0;
            }

//            Logic Game

//            New ADD Terakhir Disini
            if($match->status!='finish'){
            $match->update([
                'box_'.$request->field_no=>$match->user_2_icon,
                'turn'=>1
            ]);
            }
        }

        return response(['message'=>'success']);
    }
}
