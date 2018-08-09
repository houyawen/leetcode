<?php
/*
https://leetcode-cn.com/problems/two-sum/description/

给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。

你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。

示例:

给定 nums = [2, 7, 11, 15], target = 9

因为 nums[0] + nums[1] = 2 + 7 = 9
所以返回 [0, 1]
*/

function twoNum($arr, $target) {

	if(empty($arr) || empty($target)){
		throw new Exception('数组或者目标值不能为空', 1);		
	}

	foreach($arr as $k1 => $v1)	{
		foreach($arr as $k2 => $v2){
			if($k1 != $k2 && array_sum([$v1, $v2]) == $target) {
				return [$k1, $k2];
			}
		}
	}

	throw new Exception("未发现答案", 2);
}

//test
$test_arr = [11, 15, 2, 1, 3, 7, 4, 18];
$target = 9;

var_dump(twoNum($test_arr, $target));

?>

