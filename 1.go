/*
https://leetcode-cn.com/problems/two-sum/description/

给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。

你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。

示例:

给定 nums = [2, 7, 11, 15], target = 9

因为 nums[0] + nums[1] = 2 + 7 = 9
所以返回 [0, 1]
*/

package main

import "fmt"

func main() {
	//test
	var test_arr = []int{11, 15, 2, 1, 3, 7, 4, 18}
	target := 9

	return_data := twoSum(test_arr, target)

	fmt.Printf("%v", return_data)
}

func twoSum(nums []int, target int) []int {
	for k1, v1 := range nums {
		for k2, v2 := range nums {
			if k1 != k2 {
				var tmp = v1 + v2
				if tmp == target {
					return []int{k1, k2}
				}
			}
		}
	}

	return []int{0, 0}
}