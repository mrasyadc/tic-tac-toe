<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table='request';
    protected $fillable=['from','to','status'];
    
    public function From(){
        return $this->belongsTo(User::class,'from','id');
    }

    public function To(){
        return $this->belongsTo(User::class,'to','id');
    }
}
