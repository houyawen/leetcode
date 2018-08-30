<?php
/*
https://leetcode-cn.com/problems/valid-perfect-square/description/
给定一个数字，判断是否是完全平方数
*/
function isPerfectSquare($num){
	if ($num <= 0) {
		return false;
	}

	$start = 1;
	$end = $num;

	while (($end - $start) > 1) {
		$mid = $start + floor(($end - $start) / 2);
		if (($mid * $mid) == $num) {
			return true;
		}
		if (($mid * $mid) > $num) {
			$end = $mid;
		}
		if (($mid * $mid) < $num) {
			$start = $mid;
		}
	}

	if ((($start * $start) == $num) || (($end * $end) == $num)) {
		return true;
	}

	return false;
}

var_dump(isPerfectSquare(62346816)) . "\n";

?>