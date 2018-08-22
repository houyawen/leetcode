/*
https://leetcode-cn.com/problems/longest-substring-without-repeating-characters/description/
给定一个字符串，找出不含有重复字符的最长子串的长度。

示例：

给定 "abcabcbb" ，没有重复字符的最长子串是 "abc" ，那么长度就是3。

给定 "bbbbb" ，最长的子串就是 "b" ，长度是1。

给定 "pwwkew" ，最长子串是 "wke" ，长度是3。请注意答案必须是一个子串，"pwke" 是 子序列  而不是子串。
*/

package main

import "fmt"

func lengthOfLongestSubstring(s string) int {
	strLen := len(s)

	if strLen < 2 {
		return strLen
	}

	// maxLen := 1
	for i := 0; i < strLen; i++ {
		for j := i + 1; j < strLen + 1; j++ {
			//截取字符串
		    rs := []rune(s)
		    tmpStr := string(rs[i:j])
		    fmt.Println(tmpStr)
		    // return len(tmpStr)
		}
	}

	return 0
}

func main() {
	str := "pwwkweacccw"
	res := lengthOfLongestSubstring(str)
	fmt.Println(res)
}