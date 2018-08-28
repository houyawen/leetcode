<?php
/*
https://leetcode-cn.com/problems/climbing-stairs/description/
*/
//斐波那契数列在n比较大的时候耗时较多
// function climbStairs($n){
// 	if ($n == 0 || $n == 1 || $n == 2) {
// 		return $n;
// 	}

// 	return climbStairs($n - 1) + climbStairs($n - 2);
// }

function climbStairs($n)
{
	if ($n == 0 || $n == 1 || $n == 2) {
		return $n;
	}

	$data = [];
	$data[0] = 1;
	$data[1] = 1;
	$data[2] = 2;
	for ($i = 3; $i <= $n; $i++) { 
		$data[$i] = $data[$i-1] + $data[$i-2];
	}

	return $data[$n];
}



echo climbStairs(45) . "\n";
?>