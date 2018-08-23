<?php
/*
https://leetcode-cn.com/problems/longest-common-prefix/description/
*/

function longestCommonPrefix($str)
{
	if (count($str) <= 1) {
		return '';
	}

	$minLen = strlen($str[0]);
	foreach ($str as $value) {
		if (strlen($value) < $minLen) {
			$minLen = strlen($value);
		}
	}

	$strArray = [];
	foreach ($str as $value) {
		$strArray[] = str_split($value);
	}


	$longestCommonPrefix = '';
	for ($i = 0; $i < $minLen; $i++) {
		$flag = true;
		$firstData = $strArray[0][$i];

		foreach ($strArray as $key => $value) {
			if ($value[$i] != $firstData) {
				$flag = false;
			}
		}

		if ($flag) {
			$longestCommonPrefix .= $firstData;
		} else {
			break;
		}
	}

	return $longestCommonPrefix;
}

//test
$str = ["flower","flow","flight"];
// $str = ["dog","racecar","car"];
$res = longestCommonPrefix($str);

var_dump($res);
?>