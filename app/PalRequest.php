<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalRequest extends Model
{
    public static $pending=0;
    public static $accepted=1;
    public static $rejected=2;
    protected $fillable=[
        'user_id',
        'email',
        'pal_id',
        'message',
        'status'//0 pending acceptance, 1 accepted, 2 rejected
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','email');
    }
    public function pal(){
        return $this->belongsTo(User::class,'pal_id')->select('id','name','email');
    }
}
