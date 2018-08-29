<?php
/*
https://leetcode-cn.com/problems/two-sum-ii-input-array-is-sorted/description/
*/

function twoSum($nums, $target)
{
	$start = 0;
	$end = count($nums) - 1;

	while(($end - $start) >= 1) {
		if (($nums[$start] + $nums[$end]) == $target) {
			return [$start + 1, $end + 1];
			echo "$start====$end\n";
		}
		if (($nums[$start] + $nums[$end]) > $target) {
			echo "$start====$end\n";
			$end--;
		}
		if (($nums[$start] + $nums[$end]) < $target) {
			echo "$start====$end\n";
			$start++;
		}
	}

	if ($nums[$start] == $target) {
		return [$start + 1, $end + 1];
	}
	throw new Exception("Error Processing Request", 1);
}

//test
$nums = [1, 3, 5, 7, 8, 11, 18, 32, 56, 78, 101, 120];
$target = 50;
var_dump(twoSum($nums, $target));
?>