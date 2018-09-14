<?php
function quickSort($arr){
	$left = 0;
	$right = count($arr) - 1;
	sortQ($left, $right, $arr);
	return $arr;
}

function sortQ($left, $right, $arr){
	echo "====$left=======$right==\n";
	if ($left > $right) {
		return $arr;
	}

	var_dump($arr) . "\n";
	$i = $left;
	$j = $right;
	$base = $arr[$left];
	while ($i != $j) {
		while ($arr[$j] > $base && $i < $j) {
			$j--;
		}
		while ($arr[$i] < $base && $i < $j) {
			$i++;
		}

		if ($i < $j) {
			$tmp = $arr[$j];
			$arr[$j] = $arr[$i];
			$arr[$i] = $tmp;
		}
	}

	$arr[$left] = $arr[$i];
	$arr[$i] = $base;

	sortQ($left, $i - 1, $arr);
	sortQ($i + 1, $right, $arr);
}

$arr = [8,2,34,65,77,17,100,50,22,15,6,1,1000,999,3444,4,60,99,26,23,15];
var_dump(quickSort($arr));
?>