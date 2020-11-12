<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingRequest extends Model
{
    protected $fillable = [
        'meeting_id',
        'user_id',
        'acceptance_status',//0 pending //1 accepted -1 rejected
        'meeting_status',//0 pending //1 in progress 2 ended
    ];

}
