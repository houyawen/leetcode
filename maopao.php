<?php
/*
冒泡排序
*/

function maopao($arr){
	$length = count($arr);
	for ($i = 0; $i < $length; $i++) {
		for ($j = 0; $j < $length - $i - 1; $j++) { 
			// echo "=$i=$j=".$arr[$j+1]."==\n";
			if ($arr[$j] <= $arr[$j + 1]) {
				$tmp = $arr[$j];
				$arr[$j] = $arr[$j + 1];
				$arr[$j + 1] = $tmp;
			}
		}
	}

	return $arr;
}

$arr = [8,100,50,22,15,6,1,1000,999];
var_dump(maopao($arr));
?>