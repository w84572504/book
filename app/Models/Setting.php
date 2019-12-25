<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table = 'setting';
    public $timestamps = false;
    public function getType($name)
    {
    	$data =  $this->where('app',$name)->get()->toArray();
    	$res = [];
    	if(!empty($data)){
    		foreach ($data as $key => $value) {
    			$res[$value['var']] = $value['value'];
    		}
    	}
    	return $res;
    }
}
