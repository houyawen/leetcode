<?php
/*
https://leetcode-cn.com/problems/intersection-of-two-arrays/description/
*/
function intersection($nums1, $nums2){
	rsort($nums1);
	rsort($nums2);

	if (count($nums1) < count($nums2)) {
		$shortNums = $nums1;
		$longNums = $nums2;
	} else {
		$shortNums = $nums2;
		$longNums = $nums1;
	}

	$res = [];
	while (!empty($shortNums)) {
		if (end($shortNums) == end($longNums)) {
			$res[] = end($shortNums);
			array_pop($shortNums);
			array_pop($longNums);
		} elseif (end($shortNums) < end($longNums)) {
			array_pop($shortNums);
		} elseif (end($shortNums) > end($longNums)) {
			array_pop($longNums);
		}
	}

	return array_unique($res);
}

// $nums1 = [4,9,5];
// $nums2 = [9,4,9,8,4];
$nums1 = [1,2,2,1];
$nums2 = [2,2];
var_dump(intersection($nums1, $nums2)) . "\n";
?>