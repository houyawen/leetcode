<?php
/*
给定一个字符串，找出不含有重复字符的最长子串的长度。

示例：

给定 "abcabcbb" ，没有重复字符的最长子串是 "abc" ，那么长度就是3。

给定 "bbbbb" ，最长的子串就是 "b" ，长度是1。

给定 "pwwkew" ，最长子串是 "wke" ，长度是3。请注意答案必须是一个子串，"pwke" 是 子序列  而不是子串。
*/


function lengthOfLongestSubstring($str)
{
	$strLen = strLen($str);

	if ($strLen < 2) {
		return $strLen;
	}

	$maxLen = 1;
	for ($i = 0; $i < $strLen; $i++) {
		for ($j = $i + 1; $j < $strLen + 1; $j++) { 
			$tmpStr = substr($str, $i, $j);
			$tmpStrArr = preg_split('//', $tmpStr, -1, PREG_SPLIT_NO_EMPTY);
			$tmpStrArrUnique = array_unique($tmpStrArr);
			if (count($tmpStrArrUnique) == count($tmpStrArr) && count($tmpStrArrUnique) > $maxLen) {
				$maxLen = count($tmpStrArrUnique);
			}
		}
	}

	return $maxLen;
}

//test
$str = 'pwwkweacccw';
echo lengthOfLongestSubstring($str);

?>