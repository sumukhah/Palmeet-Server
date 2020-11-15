<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }

    public function pendingPalRequests(){
        return $this->hasMany(PalRequest::class,'user_id')
            ->where(['status'=>0]);
    }
    public function rejectedPalRequests(){
        return $this->hasMany(PalRequest::class,'user_id')
            ->where(['status'=>-1]);
    }
    public function acceptedPalRequests(){
        return $this->hasMany(PalRequest::class,'user_id')
            ->where(['status'=>1]);
    }

    public function myPendingPalRequests(){
        return $this->hasMany(PalRequest::class,'email','email')
            ->where(['status'=>0]);
    }

    public function acceptedMeetingRequests(){
        return $this->hasMany(MeetingRequest::class,'user_id')
            ->where(['acceptance_status'=>MeetingRequest::$Accepted]);
    }
    public function meetings(){
        return $this->hasMany(Meeting::class,'user_id');
    }
}
