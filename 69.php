<?php
/*
https://leetcode-cn.com/problems/sqrtx/description/
实现 int sqrt(int x) 函数。

计算并返回 x 的平方根，其中 x 是非负整数。

由于返回类型是整数，结果只保留整数的部分，小数部分将被舍去。
*/

function mySqrt($x)
{
	if ($x == 0 || $x == 1) {
		return $x;
	}

	$start = 0;
	$end = $x;

	while (true) {
		$min = ($start + $end) / 2;

		if (abs($min * $min - $x) < 0.001) {
			return floor($min);
		}

		if ($min * $min > $x) {
			echo '======' . $min . "\n";
			$end = $min;
		} else {
			$start = $min;
			echo '======' . $min . "\n";
		}
	}
}

echo mySqrt(128) . "\n";

?>