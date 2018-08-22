<?php
//一个有序数组返回指定一个value的第一个key,用二分法
function findErfen($arr, $minId, $maxId, $target)
{
	if ($minId == $maxId) {
		if ($arr[$minId] == $target) {
			return $minId;
		} else {
			throw new Exception("error", 1);
		}
	}

	if ($maxId - $minId == 1) {
		if ($arr[$minId] == $target) {
			return $minId;
		}
		if ($arr[$maxId] == $target) {
			return $maxId;
		}
		throw new Exception("error", 2);
	}

	$mId = floor(($maxId - $minId) / 2) + $minId;

	if ($arr[$mId] < $target) {
		return findErfen($arr, $mId, $maxId, $target);
	} else {
		return findErfen($arr, $minId, $mId, $target);
	}

	throw new Exception("error", 3);
}

//test
$arr = [1,5,5,6,9,11,15,16,17,19,23,27,27,30,31,32];
$target = 32;
$maxId = count($arr) - 1;
$minId = 0;
echo findErfen($arr, $minId, $maxId, $target);
?>
