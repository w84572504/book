<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WxOrder extends Model
{
    //
    protected $table = 'wx_order';  

    public function user()
    {
        return $this->belongsTo(User::class,'uid');
    }
}
