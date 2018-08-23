<?php
/*
https://leetcode-cn.com/problems/roman-to-integer/description/
*/

function romaToAlab($romaNum)
{

	$romaNum = str_split($romaNum);
	$length = count($romaNum);
	$map = ['I' => 1,'V' => 5,'X' => 10,'L' => 50,'C' => 100,'D' => 500,'M' => 1000];

	$res = 0;
	for ($i = 0; $i < $length; $i++) {
		if ($i + 1 < $length && $map[$romaNum[$i]] < $map[$romaNum[$i+1]]) {
			$res -= $map[$romaNum[$i]];
		} else {
			$res += $map[$romaNum[$i]];
		}
	}

	return $res;
}


// $a = "MCMXCIV";
$a = 'IV';
$res = romaToAlab($a);
var_dump($res);
?>