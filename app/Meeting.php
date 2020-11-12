<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public static $Pending=0;
    public static $Started=1;
    public static $Ended=2;

    protected $fillable=[
    'user_id', 'title','invitation','link',
        'meeting_starts',
        'meeting_ends',
        'status'//0 pending //1 started // 2 ended
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function meetingRequest(){
        return $this->hasMany(MeetingRequest::class,'meeting_id');
    }

}
