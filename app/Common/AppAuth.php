<?php
namespace App\Common;

use \Firebase\JWT\JWT as jwt;

class AppAuth{

    // 签发者
    private $iss = 'zuoxiang';
    // 接收该JWT的一方
    private $aud = 'zuoxiang';
    // 盐值
    private $secret = 'eWl6aGFudG9uZ2FwcA==';
    // 过期时长
    private $expLen = 7200;

    public $token;
    // 解析后的jwt数据
    private $decodeToken;
    // 用户ID
    private $uid;
    // 错误信息
    private $errMsg;

    function __construct($token = null,$uid = 0)
    {
        $this->token = $token;
        $this->uid = $uid;
    }

    public function getErrMsg()
    {
        return $this->errMsg ?? 'token未知错误';
    }

    public function getUid()
    {
        return $this->uid;
    }
    public function scopes()
    {
        if ($this->decodeToken->scopes != 'role_refresh') {
            $this->errMsg = "签名类型不正确!";
            return false;
        }
        return true;
    }
    public function role()
    {
        if ($this->decodeToken->scopes != 'role_access') {
            $this->errMsg = $this->decodeToken;
            return false;
        }
        return true;
    }
    //设置token
    public function loginToken()
    {
        $time = time(); //当前时间
        $token = [
            'iss' => $this->iss, //签发者 可选
            'aud' => $this->aud, //接收该JWT的一方，可选
            'iat' => $time, //签发时间
            'data' => [
                'uid' => $this->uid,
            ]
        ];
        $access_token = $token;
        $access_token['scopes'] = 'role_access'; //token标识，请求接口的token
        $access_token['nbf'] = $time; //表示当前时间1秒后才能使用
        $access_token['exp'] = $time+7200; //access_token过期时间,这里设置2个小时

        $refresh_token = $token;
        $refresh_token['scopes'] = 'role_refresh'; //token标识，刷新access_token
        $refresh_token['nbf'] = $time; //表示当前时间2小时后才能使用 提前一分钟为了 防止 网络传输过程时间过长造成 失效的问题
        $refresh_token['exp'] = strtotime(date('Y-m-d 4:00:00',strtotime('+10 day'))); //access_token过期时间,这里设置7天 
        $data = [
            'access_token'=>jwt::encode($access_token,$this->secret,'HS256'),
            'refresh_token'=>jwt::encode($refresh_token,$this->secret,'HS256'),
        ];
        return $data;
    }
    //解密token
    public function getToken()
    {
       try {
            $decodeToken = jwt::decode($this->token, $this->secret,array('HS256'));
            $this->decodeToken = $decodeToken;
            $this->uid = $this->decodeToken->data->uid;
        } catch (\Firebase\JWT\SignatureInvalidException $e) { // 签名不正确
            $this->errMsg = '签名不正确';
            return false;
        } catch (\Firebase\JWT\BeforeValidException $e) { // 签名在某个时间点之后才能用
            $this->errMsg = 'token签名暂不可用';
            return false;
        } catch (\Firebase\JWT\ExpiredException $e) { // token过期
            $this->errMsg = 'token过期';
            return false;
        } catch (\Exception $e) { // 其他错误
            $this->errMsg = 'token其他错误';
            return false;
        }
        return true;

    }
    public function setToken()
    {
        $time = time(); //当前时间
        $token = [
            'iss' => $this->iss, //签发者 可选
            'aud' => $this->aud, //接收该JWT的一方，可选
            'iat' => $time, //签发时间 
            'data' => [
                'uid' => $this->uid,
            ]
        ];
        $access_token = $token; 
        $access_token['scopes'] = 'role_access'; //token标识，请求接口的token
        $access_token['nbf'] = $time; //表示当前时间1秒后才能使用
        $access_token['exp'] = $time+7200; //access_token过期时间,这里设置2个小时   
        $token =  jwt::encode($access_token,$this->secret,'HS256');
        return $token;
    }
    
}