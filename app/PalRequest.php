<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PalRequest extends Model
{
    protected $fillable=[
        'user_id',
        'email',
        'pal_id',
        'status'//0 pending acceptance, 1 accepted, 2 rejected
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function pal(){
        return $this->belongsTo(User::class,'pal_id');
    }
}
