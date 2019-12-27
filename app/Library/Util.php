<?php 
/**
 * 获取时间戳
 * @param string $settime 参数 时间 20：00
 * @return array 返回值
 */
function gettimes($hour)
    {
    	# 根据时间戳比较  如果当前时间 大于 当天某个时间 返回 某个时间 至第二天的某个时间  如果小返回 前一天至今天的时间
    	$ymd = "Y-m-d". $hour .":00";
    	$setymd = date($ymd,time());
    	$settime = strtotime($setymd);
    	$array = [];
    	if (time() >= $settime) {
    		$etime = $settime+86400;
    		$array['stime'] = date('Y-m-d H:i:s',$settime);
    		$array['etime'] = date('Y-m-d H:i:s',$etime);
    	}else{
    		$stime = $settime-86400;
    		$array['stime'] = date('Y-m-d H:i:s',$stime);
    		$array['etime'] = date('Y-m-d H:i:s',$settime);
    	}
    	return $array;
    }