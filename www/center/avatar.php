<?php

/*
	[UCenter] (C)2001-2009 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: avatar.php 851 2008-12-09 01:17:59Z zhaoxiongfei $
*/


error_reporting(0);

$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : '';
$random = isset($_GET['random']) ? $_GET['random'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'real';
$check = isset($_GET['check_file_exists']) ? $_GET['check_file_exists'] : '';

$avatar = './data/avatar/'.get_avatar($uid, $size, $type);
if(file_exists(dirname(__FILE__).'/'.$avatar)) {
	if($check) {
		echo 1;
		exit;
	}
	$random = !empty($random) ? rand(1000, 9999) : '';
	$avatar_url = empty($random) ? $avatar : "$avatar?random=$random";
} else {
	if($check) {
		echo 0;
		exit;
	}
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	$avatar_url = "images/noavatar_$size.gif";
}

if(empty($random)) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Last-Modified:".date('r'));
	header("Expires: ".date('r', time() + 86400));
}

header("Location: $avatar_url");
exit;

function get_avatar($uid, $size = 'middle', $type = '') {
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	$typeadd = $type == 'real' ? '_real' : '';
	return $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).$typeadd."_avatar_$size.jpg";
}

?>
