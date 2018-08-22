<?php

function findErfen($arr, $target){
	if (empty($arr)) {
		throw new Exception("数组不能为空", 1);
	}

	$length = count($arr);

	if ($length == 1 && $arr[0] == $target) {
		return $target;
	}

	if (($length % 2) != 0) {
		$k = ($length - 1) / 2;
	} else {
		$k = ($length - 2) / 2;
	}

	if ($arr[$k] == $target) {
		return $k;
	}

	if ($arr[$k] > $target) {
		return findErfen(array_slice($arr, 0, $k), $target);
	}

	return findErfen(array_slice($arr, $k + 1, ceil($length / 2)), $target);
}

//test
$arr = [1,5,6,9,11,15,16,17,19,23,27,27,30,31,32,34];
$target = 15;

echo findErfen($arr, $target);
?>
