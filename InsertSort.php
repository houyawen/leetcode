<?php
/*
插入排序
*/

function insertSort($arr){
	for ($i = 1; $i < count($arr); $i++) {
		$insertData = $arr[$i];
		$j = $i - 1;
		while ($j >= 0 && ($arr[$j] > $insertData)) {
			$tmp = $arr[$j];
			$arr[$j] = $insertData;
			$arr[$j+1] = $tmp;
			$j--;
		}
	}
	return $arr;
}

$arr = [12,34,564,65,7,2,55,655,76];
var_dump(insertSort($arr)) . "\n";

?>