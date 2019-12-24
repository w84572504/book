<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends ApiBaseController
{
    public function index(Request $request)
    {
    	return $this->ok(['data'=>'ok']);
    }
}
