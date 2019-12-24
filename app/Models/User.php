<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'user'; 

    public function userscore()
    {
        return $this->hasMany(UserScoreLog::class,'user_id');
    }
    public function order()
    {
        return $this->hasMany(WxOrder::class,'uid');
    }
}
