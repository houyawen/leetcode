package main

import "fmt"

func main() {
	//test
	var test_arr = [...]int{11, 15, 2, 1, 3, 7, 4, 18}
	target := 9

	var first_key int
	var second_key int

	first_key, second_key := twoNum(test_arr, target)

	return_data := [2]int{first_key, second_key}

	fmt.Printf("%v", return_data)
}

func twoNum(arr, target) (int, int) {
	return 1, 2
	// for k1, v1 := range arr {
	// 	for k2, v1 := range arr {
	// 		if k1 != k2 {
	// 			var tmp = v1 + v2
	// 			if tmp == target {
	// 				return [2]int{k1, k2}
	// 			}
	// 		}
	// 	}
	// }
}