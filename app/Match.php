<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table='match';
    protected $fillable=['user_id_1','user_id_2','user_1_icon','user_2_icon','status','winner','box_1','box_2','box_3','box_4','box_5','box_6','box_7','box_8','box_9','turn'];

    public function FirstPlayer(){
        return $this->belongsTo(User::class,'user_id_1','id');
    }

    public function SecondPlayer(){
        return $this->belongsTo(User::class,'user_id_2','id');
    }

    public function Winner(){
        return $this->belongsTo(User::class,'winner','id');
    }
}
