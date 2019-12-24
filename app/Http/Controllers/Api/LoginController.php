<?php
namespace App\Http\Controllers\Api;

use App\Common\AppAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends ApiBaseController
{
    public function index(Request $request)
    {
    	$auth = new AppAuth('',1); 
        $token = $auth->loginToken();
    	return $this->ok(['data'=>$token]);
    }
}
