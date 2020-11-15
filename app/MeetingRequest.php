<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingRequest extends Model
{
    public static $Accepted=1;
    public static $Declined=-1;
    public static $Pending=0;
    protected $fillable = [
        'meeting_id',
        'user_id',
        'acceptance_status',//0 pending //1 accepted -1 rejected
        'meeting_status',//0 pending //1 in progress 2 ended
    ];

    public function invitee(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','email');
    }
    public function meeting(){
        return $this->belongsTo(Meeting::class,'meeting_id');
    }

}
