<?php
namespace App\Common;
/**
 * 
 */
class Curls
{
    /**
     * 发起curl请求
     *
     * @param string $url 要请求的url
     * @param array $parameter 请求参数
     * @param array $header header头信息
     * @param string $type 请求的数据类型 json/post/file/get/raw
     * @param int $connectTimeout 请求的连接超时时间默认10s
     * @param int $execTimeout 等待执行输出的超时时间默认30s
     *
     * @return bool|mixed
     */
    public static function goCurl($url, $parameter = [], $header = [], $type = 'json', $connectTimeout = 10, $execTimeout = 30)
    {
        $ssl = substr($url, 0, 8) == "https://" ? true : false;
        $ch = curl_init();
        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //检查证书中是否设置域名
        }

        if ($type == 'json' || $type == 'raw') {
            $type == 'json' && ($parameter = json_encode($parameter, JSON_UNESCAPED_UNICODE)) && ($header[] = 'Content-Type: application/json');
            //$queryStr = str_replace(['\/','[]'], ['/','{}'], $queryStr);//兼容
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
        } else if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameter));
        } else if ($type == 'file') {
            $isOld = substr($parameter['file'], 0, 1) == '@';
            if (function_exists('curl_file_create')) {
                $parameter['file'] = curl_file_create($isOld ? substr($parameter['file'], 1) : $parameter['file'], '');
            } else {
                $isOld || $parameter['file'] = '@' . $parameter['file'];
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
        } else {
            $queryStr = '';
            if (is_array($parameter)) {
                foreach ($parameter as $key => $val) {
                    $queryStr .= $key . '=' . $val . '&';
                }
                $queryStr = substr($queryStr, 0, -1);
                $queryStr && $url .= '?' . $queryStr;
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $execTimeout);

        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        $ret = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if (!$ret || !empty($error)) {
            return false;
        } else {
            return $ret;
        }
    }
}
