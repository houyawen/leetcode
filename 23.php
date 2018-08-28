<?php
/*
https://leetcode-cn.com/problems/remove-duplicates-from-sorted-array/description/
26. 删除排序数组中的重复项
*/

function removeDuplicates($arr)
{
	$number = 0;
	for ($i = 0; $i < count($arr); $i++) { 
		if ($arr[$number] != $arr[$i]) {
			$number++;
			$arr[$number] = $arr[$i];
		}
	}

	return $arr;
}

$arr = [0,0,1,1,1,2,2,3,3,4];
removeDuplicates($arr);

var_dump($arr);
?>