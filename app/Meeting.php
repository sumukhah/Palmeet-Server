<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public static $Pending=0;
    public static $Started=1;
    public static $Ended=2;

    protected $fillable=[
        'user_id',
        'title',
        'invitation',
        'link',
        'meeting_starts',
        'meeting_ends',
        'meeting_id',
        'meeting_password',
        'status'//0 pending //1 started // 2 ended
    ];
    public function host(){
        return $this->belongsTo(User::class,'user_id')
            ->select('id','name','email');
    }

    public function meetingRequest(){
        return $this->hasMany(MeetingRequest::class,'meeting_id');
    }
    public function attendance(){
        return $this->hasMany(MeetingRequest::class,'meeting_id')
            ->where(['acceptance_status'=>MeetingRequest::$Accepted]);
    }
    public function invites(){
        return $this->hasMany(MeetingRequest::class,'meeting_id');
    }

}
