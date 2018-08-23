<?php
/*
https://leetcode-cn.com/problems/palindrome-number/description/
判断一个整数是否是回文数。回文数是指正序（从左向右）和倒序（从右向左）读都是一样的整数。
*/
function huiWen($num)
{
	if ($num < 0) {
		return false;
	}

	if ($num < 10) {
		return true;
	}

	$remain = $num;
	$res = 0;
	while ($remain >= 10) {
		$rema = $remain % 10;
		$remain = ($remain - $rema) / 10;
		$res = $res * 10 + $rema;
	}

	$res = $res * 10 + $remain;
	return $res == $num;
}

$a = 12321;
$res = huiWen($a);
var_dump($res);
?>