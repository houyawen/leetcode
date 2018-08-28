<?php
/*
https://leetcode-cn.com/problems/search-insert-position/description/
搜索插入的位置
*/

function searchInsert($nums, $target) {
	$start = 0;
	$end = count($nums) - 1;

	$i = 1;

	if ($nums[$end] == $target) {
		return $end;
	}

	if ($target > $nums[$end]) {
		return $end + 1;
	}

	while (($end - $start) > 1) {
		$i++;
		if ($i > 20) {
			return '';
		}
		$mid = floor(($end - $start) / 2) + $start;


		if ($nums[$mid] == $target) {
			echo "=====$mid==\n";
			return $mid;
		}

		if ($nums[$mid] < $target) {
			echo "===<==$mid==\n";
			$start = $mid;
		} else {
			echo "===>==$mid==\n";
			$end = $mid;
		}
	}


	if ($nums[$start] == $target) {
		return $start;
	}

	if ($nums[$end] == $target) {
		return $end;
	}

	return $start + 1;
}


$nums = [1, 3, 5, 7, 8, 11, 18, 32, 56, 78, 101, 120];
$target = 121;


echo searchInsert($nums, $target) . "\n";
?>