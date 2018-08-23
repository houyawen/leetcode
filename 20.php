<?php
/*
https://leetcode-cn.com/problems/valid-parentheses/description/
*/

function isValid($str)
{
	$str = str_split($str);
	$tmp = [];
	foreach ($str as $v) {
		if ($v == '(') {
			array_push($tmp, ')');
		} elseif ($v == '{') {
			array_push($tmp, '}');
		} elseif ($v == '[') {
			array_push($tmp, ']');
		} elseif (array_pop($tmp) != $v) {
			return false;
		}
	}

	return empty($tmp);
}

//test
$str = "{[()]}";
$res = isValid($str);
var_dump($res);
?>